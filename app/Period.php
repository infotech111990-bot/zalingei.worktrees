<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Period extends Model
{
    protected $table = 'periods';
    protected $guarded = [];

    /**
     * Check whether a given period type is currently open.
     * If $collegeId is provided, checks college-specific periods first then fallbacks to global ones.
     *
     * @param string $type 'registration' or 'results'
     * @param int|null $collegeId
     * @return bool
     */
    public static function isOpen(string $type, $collegeId = null)
    {
        $now = Carbon::now();

        // Check college-specific active period
        if($collegeId){
            $p = self::where('type', $type)
                    ->where('active', true)
                    ->where(function($q) use ($collegeId){
                        $q->where('college_id', $collegeId);
                    })
                    ->where(function($q) use ($now){
                        $q->where(function($qq) use ($now){
                            $qq->whereNotNull('start_at')->whereNotNull('end_at')->where('start_at','<=',$now)->where('end_at','>=',$now);
                        })->orWhere(function($qq){
                            $qq->whereNull('start_at')->whereNull('end_at');
                        });
                    })->first();

            if($p) return true;
        }

        // Fallback to global (college_id NULL) active period
        $p = self::where('type', $type)
                ->where('active', true)
                ->whereNull('college_id')
                ->where(function($q) use ($now){
                    $q->where(function($qq) use ($now){
                        $qq->whereNotNull('start_at')->whereNotNull('end_at')->where('start_at','<=',$now)->where('end_at','>=',$now);
                    })->orWhere(function($qq){
                        $qq->whereNull('start_at')->whereNull('end_at');
                    });
                })->first();

        return $p ? true : false;
    }
}
