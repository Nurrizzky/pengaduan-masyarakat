<?php

namespace App\Http\Controllers;

use App\Models\Report;
use App\Models\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Http\Request;

class ReportController extends Controller
{
    // reports disiini untuk menampilkan halaman yang berisi Laporan masyarakatnya
    public function dashboard()
    {
        $reports = Report::orderBy('created_at', 'desc')->get(); 
        return view('guest.report', compact('reports'));
    }
    /**
     * Display a listing of the resource.
    */
    public function index()
    {
        if (Auth::check()) {
            //mengambil user yang sedang login
            $user = Auth::id();
            // Cek apakah ada report milik user yang sedang login
            $cekReport = Report::where('user_id', $user)->get();
            return view('guest.my-report', compact('cekReport'));
        }
    }

    public function search(Request $request)
    {
        $reports = Report::where('province', 'LIKE', '%'. $request->search_provinsi. '%')->get();
        return view('guest.report', compact('reports'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        return view('guest.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        if (Auth::check()) {
            $request->validate([
                'title' => 'required',
                'description' => 'required',
                'province' => 'required',
                'regency' => 'required',
                'subdistrict' => 'required',
                'village' => 'required',
                'type' => 'required',
                'voting' => 'nullable|array',
                'viewers' => 'nullable|integer',
                'image' => 'required|file|image',
                'statement' => 'required|boolean',
            ]);

            $imagePath = $request->file('image')->store('post-image');

            function getName($name) {
                // $name = diiisi dengan $request->(name)
                $result = explode('-', $name); // ['1', 'Jakarta']
                return $result[1]; // 'Jakarta'
            }

            $proses = Report::create([
                'user_id' => Auth::user()->id,
                'title' => $request->title,
                'description' => $request->description,
                'province' => getName($request->province),
                'regency' => getName($request->regency),
                'subdistrict' => getName($request->subdistrict),
                'type' => $request->type,
                'village' => getName($request->village),
                'image' => $imagePath,
                'statement' => $request->statement,
            ]);

            // Response::create([
            //     'staff_id' => '',
            //     'response_status' => '',
            //     'user_id' => '',
            //     'report_id' => '',
            // ]);
            if ($proses) {
                return redirect()->route('report.report')->with('success', 'Laporan berhasil dibuat');
            } else {
                return redirect()->back()->with('failed', 'Laporan gagal dibuat');
            }
        }
        else {
            return redirect()->route('login');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        //
        $reports = Report::where('id', $id)->first();
        $sesi = Auth::id().$id; //ini dibuat untuk mengambil data unik yang nantinya akan dijadikan sebuah patokan sesi
        // dd($sesi);
        if (!Session::get($sesi)) {
            $reports->increment('viewers');
            Session::put($sesi, true); // ini digunakan untuk membuat sesi / bisa diblang nyimpen sesinya
        }
        return view('guest.detail', compact('reports'));
    }

    public function voteToggle($reportId)
{
    $user = Auth::user()->id;
    $report = Report::findOrFail($reportId);

    // Cek apakah data 'voting' sudah berupa array atau string JSON
        $votingData = $report->voting ?? [];
    // Proses voting
    if (in_array($user, $votingData)) {
        // Hapus user dari daftar voting
        $votingData = array_diff($votingData, [$user]);
    } else {
        // Tambahkan user ke daftar voting
        $votingData[] = $user;
    }
    // Simpan hasil voting
    $report->voting = is_array($votingData) ? $votingData : json_encode($votingData);
    $report->save();

    return back();
}

    

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Report $report)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Report $report)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        //
        $proses = Report::where('id', $id)->delete();
        if ($proses) {
            return redirect()->back()->with('success', 'Berhasil Menghapus Akun 👌');
        } else {
            return redirect()->back()->with('failed', 'Gagal Menghapus Akun');
        }
    }
}
