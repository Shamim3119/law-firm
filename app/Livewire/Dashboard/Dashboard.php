<?php

namespace App\Livewire\Dashboard;

use Livewire\Component;
use Illuminate\Support\Facades\DB;

class Dashboard extends Component
{
    public $data;
  


    public function render()
    {

        $query = "Select
                    ifnull((select count(id) from users where inactive = 0),0) as users,
                    ifnull((select sum(charge) from cases where status_id = 0),0) as charge,
                    ifnull((select sum(payment) from cases where status_id = 0),0) as payment,
                    ifnull((select sum(due) from cases where status_id = 0),0) as due,
                    DATE_FORMAT(CURDATE(), '%d, %b %y') as today,
                    DATE_FORMAT(DATE_ADD(CURDATE(), INTERVAL 7 DAY), '%d, %b %y') AS next_day,
                    (SELECT COUNT(id) FROM appointments WHERE DATE(start_date) BETWEEN CURDATE() AND DATE_ADD(CURDATE(), INTERVAL 7 DAY)) as appointment,
                    (SELECT COUNT(id) FROM cases WHERE DATE(hearing_date) BETWEEN CURDATE() AND DATE_ADD(CURDATE(), INTERVAL 7 DAY)) as hearing,
                    DATE_FORMAT(DATE_SUB(CURDATE(), INTERVAL 7 DAY), '%d, %b %y') AS prev_day,
                    (SELECT COUNT(id) FROM appointments WHERE DATE(created_at) BETWEEN CURDATE() AND DATE_SUB(CURDATE(), INTERVAL 7 DAY)) as new_appoinment,
                    (SELECT COUNT(id) FROM cases WHERE DATE(created_at) BETWEEN CURDATE() AND DATE_SUB(CURDATE(), INTERVAL 7 DAY)) as new_cases;";

        $this->data = collect(DB::select($query))->first();

        return view('livewire.dashboard.dashboard')
        ->layout('layouts.app', ['title' => 'Dashboard', 'sub_title' => 'Dashboard Overview']);
    }
}
