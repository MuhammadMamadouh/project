<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Settings extends Model
{
    //
    protected $table = 'settings';

    /**
     * Get Columns of model
     * @return mixed
     */
    public static function getColumns()
    {
        $table = self::getTable();
        $columns = DB::getSchemaBuilder()->getColumnListing($table);
        return $columns;
    }

    protected $fillable = ['sitename', 'logo', 'icon', 'email', 'keywords', 'status', 'message_maintenance'];
}
