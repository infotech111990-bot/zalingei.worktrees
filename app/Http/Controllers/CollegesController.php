<?php

namespace App\Http\Controllers;
use App\College;
use App\Http\Controllers\Controller;

class CollegesController extends Controller
{
    /**
     * Show the profile for the given user.
     *
     * @param  int  $id
     * @return Response
     */
    public function display($slug = null, $section = null, $id = null, $deptSection = null, $cID = null)
    {
             if(isset($slug)){

              $college = \App\College::where('slug',$slug)->firstOrFail();

              // if(!$college){
              //   return abort(404);
              // }

              switch($section){
                  case 'about' : return view('site.collegesAbout',array('college' => $college));
                  break;
                  case 'vision' : return view('site.collegesVMO',array('college' => $college));
                  break;
                  case 'dean' : return view('site.collegesDean',array('college' => $college));
                  break;
                  case 'programs' : return view('site.collegesPrograms',array('college' => $college));
                  break;
                  case 'admission' : return view('site.collegesAdmission',array('college' => $college));
                  break;
                  case 'regulations' : return view('site.collegesRegulations',array('college' => $college));
                  break;
                  case 'calendar' : return view('site.collegesCalendar',array('college' => $college));
                  break;
                   case 'news' :
                    if(isset($id)){
                        return view('site.collegesNewsDisplay',array('college' => $college, 'id' => $id ));
                      }else{
                        return view('site.collegesNews',array('college' => $college));
                      }
                  break;
                  case 'announcements' :
                      return view('site.collegesAnnouncements', array('college' => $college));
                  break;
                  case 'content' :
                    if(isset($id)){
                        return view('site.collegesExtraContent',array('college' => $college, 'id' => $id));
                      }else{
                        return view('site.collegesAbout',array('college' => $college));
                      }
                  break;
                  case 'dept' :
                    if(isset($id)){
                      if(isset($deptSection)){
                        switch($deptSection){
                          case 'staff' : return view('site.collegesDepartmentStaff',array('college' => $college));
                          break;
                          case 'content' : return view('site.collegesDepartmentContent',array('college' => $college));
                          break;
                          default: return view('site.collegesDepartment',array('college' => $college));
                        }
                      }else{
                        return view('site.collegesDepartment',array('college' => $college, 'dept' => $college->departments->find($id)));
                      }
                    }else{
                      return view('site.collegesAbout',array('college' => $college));
                    }
                  break;
                  case 'staff' :
                    if(isset($id)){
                        return view('site.collegesStaffDisplay',array('college' => $college));
                      }else{
                        return view('site.collegesStaff',array('college' => $college));
                      }
                  break;
                  case 'prof' :
                    if(isset($id)){
                        return view('site.collegesStaffDisplay',array('college' => $college));
                      }else{
                        return view('site.collegesProf',array('college' => $college));
                      }
                  break;
                  default : return view('site.collegeMain',array('college' => $college));
                }
              }else{
                return abort(404);
              }
    }
}