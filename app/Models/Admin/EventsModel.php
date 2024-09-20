<?php

namespace App\Models\Admin;

use CodeIgniter\Model;

class EventsModel extends Model
{
    protected $table            = 'events';
    protected $primaryKey       = 'event_id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = [
        'user_id', 'publishstatus', 'eventbanner', 'category_id', 'eventname', 'slug', 'shortdescription', 'eventtype', 'eventdate', 'eventstartingtime', 'eventendingtime', 'recurrence', 'locationname', 'state_id', 'city_id', 'event_image', 'event_video', 'eventdescription', 'eventdescription', 'publishsetting', 'refundpolicy', 'dateadded'
    ];

    protected bool $allowEmptyInserts = false;
    protected bool $updateOnlyChanged = true;

    protected array $casts = [];
    protected array $castHandlers = [];

    // Dates
    protected $useTimestamps = false;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';

    // Validation
    protected $validationRules      = [];
    protected $validationMessages   = [];
    protected $skipValidation       = false;
    protected $cleanValidationRules = true;

    // Callbacks
    protected $allowCallbacks = true;
    protected $beforeInsert   = [];
    protected $afterInsert    = [];
    protected $beforeUpdate   = [];
    protected $afterUpdate    = [];
    protected $beforeFind     = [];
    protected $afterFind      = [];
    protected $beforeDelete   = [];
    protected $afterDelete    = [];
}
