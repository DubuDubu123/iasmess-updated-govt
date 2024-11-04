<?php
namespace App\Exports;

use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\Exportable;

class UsersExport implements FromView, ShouldAutoSize
{
    use Exportable;

    protected $result;

    public function __construct($result)
    {
        $this->result = $result;
    }

    public function view(): View
    {
        return view('admin.users.exports.user', [
            'results' => $this->result
        ]);
    }
}
