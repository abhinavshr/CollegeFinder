<?php

namespace App\Http\Controllers\collegeAdmin;

use App\Http\Controllers\Controller;
use App\Models\CollegeAdmin;
use App\Models\Colleges;
use App\Models\RecentActivity;
use App\Models\User;
use Illuminate\Http\Request;
use Carbon\Carbon;

class DashboardController extends Controller
{

    public function dashboardindex()
    {
        $colleges = Colleges::count();
        $collegeadmin = CollegeAdmin::count();
        $user = User::count();

        $months = collect();
        $now = Carbon::now();

        for ($i = 11; $i >= 0; $i--) {
            $months->put($now->copy()->subMonths($i)->format('M'), 0);
        }

        $userRegistrations = User::whereBetween('created_at', [$now->copy()->subMonths(11)->startOfMonth(), $now->endOfMonth()])
            ->selectRaw('COUNT(id) as count, DATE_FORMAT(created_at, "%b") as month')
            ->groupBy('month')
            ->orderByRaw('MIN(created_at)')
            ->pluck('count', 'month');

        $monthlyData = $months->merge($userRegistrations)->values()->toArray();

        $recentActivities = RecentActivity::latest()->take(5)->get();

        return view('collegeAdmin.dashboard', compact('colleges', 'collegeadmin', 'user', 'monthlyData', 'recentActivities'));
    }
}
