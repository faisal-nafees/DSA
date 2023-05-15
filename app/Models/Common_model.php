<?php

namespace App\Models;

use Auth;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Request;

class Common_model extends Model
{
    use HasFactory;
    private $commonModel;

    public function check_where($tableName, $column = null, $value = null)
    {
        $query = DB::table($tableName);
        if ($tableName && $column && $value) {
            $query->where($column, $value);
        } elseif ($tableName && $column && !$value) {
            $query->whereMonth($column, Carbon::now()->month);
        }
        return $query->count();
    }

    public function insert_data($tableName, $dataArray)
    {
        return DB::table($tableName)->insert($dataArray);
    }

    public function edit_data($tableName, $column, $value, $data_array)
    {
        return DB::table($tableName)->where($column, $value)->update($data_array);
    }

    public function delete_data($tableName, $column, $value)
    {
        return DB::table($tableName)->where($column, $value)->delete();
    }

    public function fetch_data($tableName, $joinTable1 = null, $joinColumn1 = null, $joinColumn2 = null, $joinTable2 = null, $joinColumn3 = null, $joinColumn4 = null, $joinTable3 = null, $joinColumn5 = null, $joinColumn6 = null)
    {
        $query = DB::table($tableName);

        if ($joinTable1 && $joinColumn1 && $joinColumn2) {
            $query->join($joinTable1, $joinColumn1, '=', $joinColumn2);
        }

        if ($joinTable2 && $joinColumn3 && $joinColumn4) {
            $query->join($joinTable2, $joinColumn3, '=', $joinColumn4);
        }

        if ($joinTable3 && $joinColumn5 && $joinColumn6) {
            $query->join($joinTable3, $joinColumn5, '=', $joinColumn6);
        }

        return $query->get();
    }


    public function fetch_where($tableName, $column, $value, $joinTable1 = null, $joinColumn1 = null, $joinColumn2 = null, $joinTable2 = null, $joinColumn3 = null, $joinColumn4 = null)
    {
        $query = DB::table($tableName)->where($column, $value);

        if ($joinTable1 && $joinColumn1 && $joinColumn2) {
            $query->join($joinTable1, $joinColumn1, '=', $joinColumn2);
        }

        if ($joinTable2 && $joinColumn3 && $joinColumn4) {
            $query->join($joinTable2, $joinColumn3, '=', $joinColumn4);
        }

        return $query->first();
    }

    public function search_data($tableName, $fieldName = null, $startDate = null, $endDate = null,  $dateFieldName = null, $searchTerm = null, $joinTable1 = null, $joinColumn1 = null, $joinColumn2 = null, $joinTable2 = null, $joinColumn3 = null, $joinColumn4 = null, $joinTable3 = null, $joinColumn5 = null, $joinColumn6 = null)
    {
        $query = DB::table($tableName);

        if ($startDate && $dateFieldName) {
            $query->whereDate($tableName . '.' . $dateFieldName, '>=', $startDate);
        } elseif ($startDate) {
            $query->whereDate($tableName . '.created_at', '>=', $startDate);
        }
        if ($endDate && $dateFieldName) {
            $query->whereDate($tableName . '.' . $dateFieldName, '<=', $endDate);
        } elseif ($endDate) {
            $query->whereDate($tableName . '.created_at', '<=', $endDate);
        }
        if ($searchTerm && $fieldName) {
            $query->where($tableName . '.' . $fieldName, $searchTerm);
        }
        if ($joinTable1 && $joinColumn1 && $joinColumn2) {
            $query->join($joinTable1, $joinColumn1, '=', $joinColumn2);
        }
        if ($joinTable2 && $joinColumn3 && $joinColumn4) {
            $query->join($joinTable2, $joinColumn3, '=', $joinColumn4);
        }
        if ($joinTable3 && $joinColumn5 && $joinColumn6) {
            $query->join($joinTable3, $joinColumn5, '=', $joinColumn6);
        }
        return $query->get();
    }

    public function search_today($tableName, $startDate = null, $dateFieldName = null, $joinTable1 = null, $joinColumn1 = null, $joinColumn2 = null, $joinTable2 = null, $joinColumn3 = null, $joinColumn4 = null, $joinTable3 = null, $joinColumn5 = null, $joinColumn6 = null)
    {
        $query = DB::table($tableName);

        if ($startDate && $dateFieldName) {
            $query->whereDate($tableName . '.' . $dateFieldName, '=', $startDate);
        }
        if ($joinTable1 && $joinColumn1 && $joinColumn2) {
            $query->join($joinTable1, $joinColumn1, '=', $joinColumn2);
        }
        if ($joinTable2 && $joinColumn3 && $joinColumn4) {
            $query->join($joinTable2, $joinColumn3, '=', $joinColumn4);
        }
        if ($joinTable3 && $joinColumn5 && $joinColumn6) {
            $query->join($joinTable3, $joinColumn5, '=', $joinColumn6);
        }
        return $query->get();
    }
}
