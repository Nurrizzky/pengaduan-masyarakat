<?php

namespace App\Http\Controllers;

use App\Models\StaffProvince;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Report;
use App\Models\User;
use Illuminate\Support\Str;
use App\Models\Response;
use App\Models\ResponseProgres;

class StaffProvinceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $reports = Report::all();
        return view('staff.dashboard', compact('reports'));
    }

    // #######
    // STAFF
    // #######

    public function dashboardStaff() 
    {
        $reports = Report::where('province', Auth::user()->staffProvince->province)->get();
        return view('staff.dashboard', compact('reports'));    
    }

    public function votingCount(Request $request) 
    {
        // Ambil parameter 'voting' dari URL, default ke 'asc'
        $votingOrder = $request->query('voting', 'asc');

        // Query dengan sorting berdasarkan voting
        $reports = Report::where('province', Auth::user()->staffProvince->province)->orderBy('voting', $votingOrder)->get();

        // Kirim data ke view
        
        return view('staff.dashboard', compact('reports', 'votingOrder'));
    }

    public function followUp(Request $request, $reportId)
    {
        $request->validate([
            'response' => 'required|string',
        ]);

        $staff = Auth::user()->id;

        $response = Response::where('report_id', $reportId)->first();

        if ($response) {
            if ($request->response == 'ON_PROSESS') {
                $response->update([
                    'staff_id' => $staff,
                    'response_status' => $request->response,
                ]);
                return redirect()->route('staff.history', $request->id);
            }else {
                return redirect()->back()->with('failed', 'GAGAL Memilih response');
            }
        }else {
            if ($request->response == 'ON_PROSESS') {
                $response = Response::create([
                    'staff_id' => $staff,
                    'report_id' => $reportId,
                    'response_status' => $request->response,
                ]);
                return redirect()->route('staff.complite', $request->id);
            }else {
                return redirect()->back()->with('failed', 'Gagal Memilih response');
            }
        }

        if ($response) {
            return redirect()->back()->with('success', 'Laporan berhasil ditanggapi.');
        } else {
            return redirect()->back()->with('failed', 'Laporan gagal ditanggapi.');
        }
    }

    public function responseHistory($id) {
        $reports = Report::where('id', $id)->first();
        return view('staff.response', compact('reports'));
    }

    public function storeProgress(Request $request, $id) {
        $request->validate([
            'progress' => 'required'
        ]);

        $report = Report::where('id', $id)->first();

        $proses = ResponseProgres::create([
            'response_id' => $report,
            'histories' => $request->progress
        ]);

        if ($proses) {
            return redirect()->back()->with('success', 'Berhasil Menambah Progres');
        } else {
            return redirect()->back()->with('failed', 'Gagal Menambah Progress');
        }

    }


    public function completion($id)
{
    $report = Report::findOrFail($id);
    $responseId = $report->response->id;
    $staff = Auth::user()->email;
    $responseProgress = ResponseProgres::where('response_id', $responseId)->get();

    dd($responseProgress); // Tambahkan ini untuk debugging
    return view('staff.response', compact('report', 'responseProgress', 'staff'));
}








    
    // #######
    // Head STAFF
    // #######

    public function dashboardHead() {
        $usersStaff = User::where('role', 'staff')->get();
        return view('head-staff.dashboard', compact('usersStaff'));
    }

    public function province() {
        $report = Report::where('province', Auth::user()->staffProvince->province)->get();
        $provinceName = $report->province;
    }

    public function chart() {
        $reports = Report::all();
        return view('head-staff.chart', compact('reports'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function storeHead(Request $request)
    {
        //
        if (Auth::check()) {
            $request->validate([
                'email' => 'required|email',
                'password' => 'required|min:6',
            ]);
    
            $user = User::create([
                'email' => $request->email,
                'role' => 'staff',
                'password' => bcrypt($request->password),
            ]);

            $headStaffProvince = Auth::user()->staffProvince->province;

            $proses = StaffProvince::create([
                'user_id' => $user->id,
                'province' => $headStaffProvince,
            ]);
    
            if ($proses) {
                return redirect()->back()->with('success', 'Berhasil Membuat Staff');
            } else {
                return redirect()->back()->with('failed', 'Gagal Membuat Staff');
            }
        }

    }

    /**
     * Display the specified resource.
     */
    public function show(StaffProvince $staffProvince)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(StaffProvince $staffProvince)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, StaffProvince $staffProvince)
    {
        //
    }

    public function resetPassword($id) 
    {
        $user = User::find($id);
        // $user = User::where('id', $id)->get();
        $proses = explode('@', $user->email);
        $pros = Str::substr($proses[0], 0, 4);
        if (!$proses) {
            return redirect()->back();
        } 
        $user->update([
            'password' => bcrypt($pros),
        ]);

        return redirect()->back()->with('success', 'Berhasil meriset password');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function delete($id)
    {
        //
        $proses = User::where('id', $id)->delete();
        if($proses) {
            return redirect()->back()->with('success', 'berhasil ');
        } else {
            return redirect()->back()->with('failed', 'gagal');
        }
    }
}
