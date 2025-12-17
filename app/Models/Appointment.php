<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
class Appointment extends Model {
    use HasFactory;
    protected $primaryKey = 'AppointmentID';
    protected $guarded = [];
    public function client() { return $this->belongsTo(Client::class, 'ClientID'); }
    public function staff() { return $this->belongsTo(Staff::class, 'StaffID'); }
    public function service() { return $this->belongsTo(Service::class, 'ServiceID'); }
}