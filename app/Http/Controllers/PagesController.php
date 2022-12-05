<?php

namespace App\Http\Controllers;


use App\Http\Controllers\Controller;
use App\Models\home;
use App\Models\about;
use App\Models\cases;
use App\Models\teams;
use App\Models\contactus;
use App\Models\contactform;
use App\Models\zonesform;
use App\Models\thanks;
use App\Models\faqs;
use App\Models\rules;
use App\Models\footer;
use App\Models\ctemplate;
use App\Models\ztemplate;
use App\Models\User;
use App\Models\involved;
use App\Models\examples;
use App\Models\clientlogos;
use App\Models\homeslider;
use App\Models\fossilfreezones;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;
use Input;
use DB;
use Hash;
use Image;
use App\mailing;
use Illuminate\Support\Facades\Mail;
use App\Mail\SendContactFormMail;
use App\Mail\SendZonesFormMail;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Response;

class PagesController extends Controller
{

    //------------------------------------------------ Home Page APIS Start-------------------------------------------------//

    public function getHomePageData(){
        try {

            $homedata = home::all();
            $logos = clientlogos::all();
            $slides = homeslider::all();

            return response()->json([
                'error' => false,
                'data' => $homedata,
                'data_images' => $logos,
                'data_slides' => $slides,
                'image_path' => '/images/'
            ], 200);

        } catch (\Throwable $e) {
            return response()->json([
                'error' => true,
                'message' => 'Some Internal Server Error Occured',
                'message_key' => 'internal_error',
                'errors' => $e->getMessage()
            ], 500);
        }
    }

    public function homePageContent(Request $request){
        try{

            
            $validateUser = Validator::make($request->all(), [
                'dataId'=> 'required',
                'heroheading1' => 'required',
                'heroheading2' => 'required',
                'heroheading3' => 'required',
                'heropara' => 'required',
                'mapheading1' => 'required',
                'mapheading2' => 'required',
                'sliderheading' => 'required',
                'counter1' => 'required',
                'counter2' => 'required',
                'counter3' => 'required',
                'counter1heading' => 'required',
                'counter2heading' => 'required',
                'counter3heading' => 'required',

            ]);
    
            if($validateUser->fails()) {
                return response()->json([
                    'error' => true,
                    'message' => 'Validation Failed',
                    'message_key' => 'validation_failed',
                    'errors' => $validateUser->errors()
                ], 200);
            }


            $homedata = home::find($request->dataId);
            $homedata->heroheading1 = request('heroheading1');
            $homedata->heroheading2 = request('heroheading2');
            $homedata->heroheading3 = request('heroheading3');
            $homedata->heropara = request('heropara');
            $homedata->mapheading1 = request('mapheading1');
            $homedata->mapheading2 = request('mapheading2');
            $homedata->sliderheading = request('sliderheading');
            $homedata->counter1 = request('counter1');
            $homedata->counter2 = request('counter2');
            $homedata->counter3 = request('counter3');
            $homedata->counter1heading = request('counter1heading');
            $homedata->counter2heading = request('counter2heading');
            $homedata->counter3heading = request('counter3heading');


            $home=$homedata->save();

            return response()->json([
                'error' => false,
                'message_key' => 'record_update',
                'message' => 'Record Sucessfully Updated',
                'response'=> $home,
            ], 200);

        }

        catch (\Throwable $e) {
            return response()->json([
                'error' => true,
                'message' => 'Some Internal Server Error Occured',
                'message_key' => 'internal_error',
                'errors' => $e->getMessage()
            ], 500);
        }
    }
    //------------------------------------------------ About Page APIS Start-------------------------------------------------//

    public function getAboutPageData(){
        try {

            $aboutdata = about::all();
            $logos = clientlogos::all();
            $teams = teams::orderBy('sorting')->get();
            $thanks = thanks::orderBy('sorting')->get();
            return response()->json([
                'error' => false,
                'data' => $aboutdata,
                'data_images' => $logos,
                'data_teams' => $teams,
                'data_thanks' => $thanks,
                'image_path' => '/images/'
            ], 200);

        } catch (\Throwable $e) {
            return response()->json([
                'error' => true,
                'message' => 'Some Internal Server Error Occured',
                'message_key' => 'internal_error',
                'errors' => $e->getMessage()
            ], 500);
        }
    }

    public function aboutPageContent(Request $request){
        try{

            
            $validateUser = Validator::make($request->all(), [
                'dataId'=> 'required',
                'heading1' => 'required',
                'heading2' => 'required',
                'para1' => 'required',
               
                'heading3' => 'required',
                'para3' => 'required',
                'heading4' => 'required',
                'heading5' => 'required',
                'para4' => 'required',
                'heading6' => 'required',
                'para5' => 'required',
                'heading7' => 'required',
                'para6' => 'required',
                'heading8' => 'required',
                'heading9' => 'required',
                'para7' => 'required',
                'heading10' => 'required',
                'para8' => 'required',
                'cimage' => 'required',
                'iimage' => 'required',

            ]);

           

            
            if($validateUser->fails()) {
                return response()->json([
                    'error' => true,
                    'message' => 'Validation Failed',
                    'message_key' => 'validation_failed',
                    'errors' => $validateUser->errors()
                ], 200);
            }


            $aboutdata = about::find($request->dataId);
            $aboutdata->heading1 = request('heading1');
            $aboutdata->heading2 = request('heading2');
            $aboutdata->para1 = request('para1');
            $aboutdata->para2 = request('para2');
            $aboutdata->heading3 = request('heading3');
            $aboutdata->para3 = request('para3');
            $aboutdata->heading4 = request('heading4');
            $aboutdata->heading5 = request('heading5');
            $aboutdata->para4 = request('para4');
            $aboutdata->heading6 = request('heading6');
            $aboutdata->para5 = request('para5');
            $aboutdata->heading7 = request('heading7');
            $aboutdata->para6 = request('para6');
            $aboutdata->heading8 = request('heading8');
            $aboutdata->heading9 = request('heading9');
            $aboutdata->para7 = request('para7');
            $aboutdata->heading10 = request('heading10');
            $aboutdata->para8 = request('para8');

            
       
       if ($request->hasFile('cimage')) {
               $file = array('cimage' => request('cimage'));
               $destinationPath = 'images/'; // upload path
               $extension = request('cimage')->getClientOriginalExtension();
               $fileName = rand(11111,99999).'.'.$extension; // renaming image
               request('cimage')->move($destinationPath, $fileName);
               $aboutdata->cimage = $fileName;
           }

           if ($request->hasFile('iimage')) {
            $file = array('iimage' => request('iimage'));
            $destinationPath = 'images/'; // upload path
            $extension = request('iimage')->getClientOriginalExtension();
            $fileName = rand(11111,99999).'.'.$extension; // renaming image
            request('iimage')->move($destinationPath, $fileName);
            $aboutdata->iimage = $fileName;
        }
          
            $about=$aboutdata->save();

            return response()->json([
                'error' => false,
                'message_key' => 'record_update',
                'message' => 'Record Sucessfully Updated',
                'response'=> $about,
            ], 200);

        }

        catch (\Throwable $e) {
            return response()->json([
                'error' => true,
                'message' => 'Some Internal Server Error Occured',
                'message_key' => 'internal_error',
                'errors' => $e->getMessage()
            ], 500);
        }
    }
    //------------------------------------------------ Examples Page APIS Start-------------------------------------------------//

    public function getExamplesPageData(){
        try {

            $examples = examples::all();
            $cases = cases::all();

            return response()->json([
                'error' => false,
                'data' => $examples,
                'data_cases' => $cases,
                'image_path' => '/images/',
            ], 200);

        } catch (\Throwable $e) {
            return response()->json([
                'error' => true,
                'message' => 'Some Internal Server Error Occured',
                'message_key' => 'internal_error',
                'errors' => $e->getMessage()
            ], 500);
        }
    }

    public function examplesPageContent(Request $request){
        try{

            
            $validateUser = Validator::make($request->all(), [
                'dataId'=> 'required',
                'heading1' => 'required',
                'heading2' => 'required',
                'para' => 'required',
                

            ]);
            
            if($validateUser->fails()) {
                return response()->json([
                    'error' => true,
                    'message' => 'Validation Failed',
                    'message_key' => 'validation_failed',
                    'errors' => $validateUser->errors()
                ], 200);
            }


            $examples = examples::find($request->dataId);
            $examples->heading1 = request('heading1');
            $examples->heading2 = request('heading2');
            $examples->para = request('para');
           

            $example=$examples->save();

            return response()->json([
                'error' => false,
                'message_key' => 'record_update',
                'message' => 'Record Sucessfully Updated',
                'response'=> $example,
            ], 200);

        }
        catch (\Throwable $e) {
            return response()->json([
                'error' => true,
                'message' => 'Some Internal Server Error Occured',
                'message_key' => 'internal_error',
                'errors' => $e->getMessage()
            ], 500);
        }
    }

    public function addCaseStudies(Request $request){
        try{
            $validateUser = Validator::make($request->all(), [
                'name' => 'required',
                'description' => 'required',
                'authorname' => 'required',
                'publishedin' => 'required',
                'rating' => 'required',
                'image' => 'required',
                'pdf' => 'required',
              

            ]);

            if($validateUser->fails()) {
                return response()->json([
                    'error' => true,
                    'message' => 'Validation Failed',
                    'message_key' => 'validation_failed',
                    'errors' => $validateUser->errors()
                ], 200);
            }

            $cases = new cases();
            $cases->name = request('name');
            $cases->description = request('description');
            $cases->authorname = request('authorname');
            $cases->publishedin = request('publishedin');
            $cases->rating = request('rating');

            request()->validate([
                'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:10000',
                'pdf' => 'required|mimes:jpeg,png,jpg,gif,svg,csv,txt,xlx,xls,pdf|max:1000000',
            ]);
       
       if ($request->hasFile('image')) {
               $file = array('image' => request('image'));
               $destinationPath = 'images/'; // upload path
               $extension = request('image')->getClientOriginalExtension();
               $fileName = rand(11111,99999).'.'.$extension; // renaming image
               request('image')->move($destinationPath, $fileName);
               $cases->image = $fileName;
           }

           if ($request->hasFile('pdf')) {
            $file = array('pdf' => request('pdf'));
            $destinationPath = 'images/'; // upload path
            $extension = request('pdf')->getClientOriginalExtension();
            $fileName = rand(11111,99999).'.'.$extension; // renaming image
            request('pdf')->move($destinationPath, $fileName);
            $cases->pdf = $fileName;
        }
          

            $case=$cases->save();

            return response()->json([
                'error' => false,
                'message_key' => 'record_update',
                'message' => 'Record Sucessfully Inserted',
                'response'=> $case,
            ], 200);

        }

        catch (\Throwable $e) {
            return response()->json([
                'error' => true,
                'message' => 'Some Internal Server Error Occured',
                'message_key' => 'internal_error',
                'errors' => $e->getMessage()
            ], 500);
        }
    }

    public function getCasesRecord(){
        try {

            $cases = cases::all();
           
            return response()->json([
                'error' => false,
                'data' => $cases,
                'image_path' => '/images/',
            ], 200);

        } catch (\Throwable $e) {
            return response()->json([
                'error' => true,
                'message' => 'Some Internal Server Error Occured',
                'message_key' => 'internal_error',
                'errors' => $e->getMessage()
            ], 500);
        }
    }

    public function deleteCases(Request $request){
        try{

            
            $validateUser = Validator::make($request->all(), [
                'casesId'=> 'required',

            ]);

           

            
            if($validateUser->fails()) {
                return response()->json([
                    'error' => true,
                    'message' => 'Validation Failed',
                    'message_key' => 'validation_failed',
                    'errors' => $validateUser->errors()
                ], 200);
            }

           
            $case = cases::find($request->casesId);
            $done=$case->delete();
         
          
           

            return response()->json([
                'error' => false,
                'message_key' => 'record_update',
                'message' => 'Record Sucessfully Deleted',
                'response'=> $done,
            ], 200);

        }

        catch (\Throwable $e) {
            return response()->json([
                'error' => true,
                'message' => 'Some Internal Server Error Occured',
                'message_key' => 'internal_error',
                'errors' => $e->getMessage()
            ], 500);
        }
    }

    public function updateCases(Request $request){
        try{

            
            $validateUser = Validator::make($request->all(), [
                'dataId'=> 'required',
                'name' => 'required',
                'authorname' => 'required',
                'description' => 'required',
                'publishedin' => 'required',
                'rating' => 'required',
                'image' => 'required',

            ]);

           

            
            if($validateUser->fails()) {
                return response()->json([
                    'error' => true,
                    'message' => 'Validation Failed',
                    'message_key' => 'validation_failed',
                    'errors' => $validateUser->errors()
                ], 200);
            }

           
            $cases = cases::find($request->dataId);
            $cases->name = request('name');
            $cases->authorname = request('authorname');
            $cases->description = request('description');
            $cases->publishedin = request('publishedin');
            $cases->rating = request('rating');

            if ($request->hasFile('image')) {
                $file = array('image' => request('image'));
                $destinationPath = 'images/'; // upload path
                $extension = request('image')->getClientOriginalExtension();
                $fileName = rand(11111,99999).'.'.$extension; // renaming image
                request('image')->move($destinationPath, $fileName);
                $cases->image = $fileName;
            }
          
            if ($request->hasFile('pdf')) {
                $file = array('pdf' => request('pdf'));
                $destinationPath = 'images/'; // upload path
                $extension = request('pdf')->getClientOriginalExtension();
                $fileName = rand(11111,99999).'.'.$extension; // renaming image
                request('pdf')->move($destinationPath, $fileName);
                $cases->pdf = $fileName;
            }
          
            $case=$cases->save();

            return response()->json([
                'error' => false,
                'message_key' => 'record_update',
                'message' => 'Record Sucessfully Updated',
                'response'=> $case,
            ], 200);

        }

        catch (\Throwable $e) {
            return response()->json([
                'error' => true,
                'message' => 'Some Internal Server Error Occured',
                'message_key' => 'internal_error',
                'errors' => $e->getMessage()
            ], 500);
        }
    }
    //------------------------------------------------ Pictorial Content APIS Start-------------------------------------------------//

    public function addClientLogos(Request $request){
        try{
            $validateUser = Validator::make($request->all(), [
                'image' => 'required',

            ]);

            if($validateUser->fails()) {
                return response()->json([
                    'error' => true,
                    'message' => 'Validation Failed',
                    'message_key' => 'validation_failed',
                    'errors' => $validateUser->errors()
                ], 200);
            }

            $logo = new clientlogos();
            $logo->name = request('name');

            request()->validate([
                'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:10000',
            ]);
       
       if ($request->hasFile('image')) {
               $file = array('image' => request('image'));
               $destinationPath = 'images/'; // upload path
               $extension = request('image')->getClientOriginalExtension();
               $fileName = rand(11111,99999).'.'.$extension; // renaming image
               request('image')->move($destinationPath, $fileName);
               $logo->image = $fileName;
           }
          

            $log=$logo->save();

            return response()->json([
                'error' => false,
                'message_key' => 'record_update',
                'message' => 'Record Sucessfully Inserted',
                'response'=> $log,
            ], 200);

        }

        catch (\Throwable $e) {
            return response()->json([
                'error' => true,
                'message' => 'Some Internal Server Error Occured',
                'message_key' => 'internal_error',
                'errors' => $e->getMessage()
            ], 500);
        }
    }

    public function addSlides(Request $request){




        try{
            $validateUser = Validator::make($request->all(), [
                'image' => 'required',
                'name' => 'required',
                'status' => 'required',
                'location' => 'required',
            ]);

            if($validateUser->fails()) {
                return response()->json([
                    'error' => true,
                    'message' => 'Validation Failed',
                    'message_key' => 'validation_failed',
                    'errors' => $validateUser->errors()
                ], 200);
            }

            $slides = new homeslider();
            $slides->name = request('name');
            $slides->status = request('status');
            $slides->location = request('location');

            request()->validate([
                'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:100000',
            ]);
       
       if ($request->hasFile('image')) {
               $file = array('image' => request('image'));
               $destinationPath = 'images/'; // upload path
               $extension = request('image')->getClientOriginalExtension();
               $fileName = rand(11111,99999).'.'.$extension; // renaming image
               request('image')->move($destinationPath, $fileName);
               $slides->image = $fileName;
           }
          

            $slide=$slides->save();

            return response()->json([
                'error' => false,
                'message_key' => 'record_update',
                'message' => 'Record Sucessfully Inserted',
                'response'=> $slide,
            ], 200);

        }

        catch (\Throwable $e) {
            return response()->json([
                'error' => true,
                'message' => 'Some Internal Server Error Occured',
                'message_key' => 'internal_error',
                'errors' => $e->getMessage()
            ], 500);
        }
    }

    public function addTeamMember(Request $request){
        try{
            $validateUser = Validator::make($request->all(), [
                'name' => 'required',
                'post' => 'required',
                'sorting' => 'required',
                'image' => 'required',
              

            ]);

            if($validateUser->fails()) {
                return response()->json([
                    'error' => true,
                    'message' => 'Validation Failed',
                    'message_key' => 'validation_failed',
                    'errors' => $validateUser->errors()
                ], 200);
            }

            $members = new teams();
            $members->name = request('name');
            $members->post = request('post');
            $members->sorting = request('sorting');
            

            request()->validate([
                'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:10000',
            ]);
       
       if ($request->hasFile('image')) {
               $file = array('image' => request('image'));
               $destinationPath = 'images/'; // upload path
               $extension = request('image')->getClientOriginalExtension();
               $fileName = rand(11111,99999).'.'.$extension; // renaming image
               request('image')->move($destinationPath, $fileName);
               $members->image = $fileName;
           }
          

            $member=$members->save();

            return response()->json([
                'error' => false,
                'message_key' => 'record_update',
                'message' => 'Record Sucessfully Inserted',
                'response'=> $member,
            ], 200);

        }

        catch (\Throwable $e) {
            return response()->json([
                'error' => true,
                'message' => 'Some Internal Server Error Occured',
                'message_key' => 'internal_error',
                'errors' => $e->getMessage()
            ], 500);
        }
    }

    public function addThanks(Request $request){
        try{
            $validateUser = Validator::make($request->all(), [
                'name' => 'required',
                'post' => 'required',
                'sorting' => 'required',
                'image' => 'required',
              

            ]);

            if($validateUser->fails()) {
                return response()->json([
                    'error' => true,
                    'message' => 'Validation Failed',
                    'message_key' => 'validation_failed',
                    'errors' => $validateUser->errors()
                ], 200);
            }

            $members = new thanks();
            $members->name = request('name');
            $members->post = request('post');
            $members->sorting = request('sorting');
            

            request()->validate([
                'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:10000',
            ]);
       
       if ($request->hasFile('image')) {
               $file = array('image' => request('image'));
               $destinationPath = 'images/'; // upload path
               $extension = request('image')->getClientOriginalExtension();
               $fileName = rand(11111,99999).'.'.$extension; // renaming image
               request('image')->move($destinationPath, $fileName);
               $members->image = $fileName;
           }
          

            $member=$members->save();

            return response()->json([
                'error' => false,
                'message_key' => 'record_update',
                'message' => 'Record Sucessfully Inserted',
                'response'=> $member,
            ], 200);

        }

        catch (\Throwable $e) {
            return response()->json([
                'error' => true,
                'message' => 'Some Internal Server Error Occured',
                'message_key' => 'internal_error',
                'errors' => $e->getMessage()
            ], 500);
        }
    }

    public function getTeamsRecord(){
        try {

            $team = teams::all();
           
            return response()->json([
                'error' => false,
                'data' => $team,
                'image_path' => '/images/',
            ], 200);

        } catch (\Throwable $e) {
            return response()->json([
                'error' => true,
                'message' => 'Some Internal Server Error Occured',
                'message_key' => 'internal_error',
                'errors' => $e->getMessage()
            ], 500);
        }
    }

    public function getThanksRecord(){
        try {

            $team = thanks::all();
           
            return response()->json([
                'error' => false,
                'data' => $team,
                'image_path' => '/images/',
            ], 200);

        } catch (\Throwable $e) {
            return response()->json([
                'error' => true,
                'message' => 'Some Internal Server Error Occured',
                'message_key' => 'internal_error',
                'errors' => $e->getMessage()
            ], 500);
        }
    }

    public function updateMember(Request $request){
        try{

            
            $validateUser = Validator::make($request->all(), [
                'dataId'=> 'required',
                'name' => 'required',
                'post' => 'required',
                'sorting' => 'required',
                'image' => 'required',

            ]);

           

            
            if($validateUser->fails()) {
                return response()->json([
                    'error' => true,
                    'message' => 'Validation Failed',
                    'message_key' => 'validation_failed',
                    'errors' => $validateUser->errors()
                ], 200);
            }

           
            $member = teams::find($request->dataId);
            $member->name = request('name');
            $member->post = request('post');
            $member->sorting = request('sorting');
            
            
       
       if ($request->hasFile('image')) {
               $file = array('image' => request('image'));
               $destinationPath = 'images/'; // upload path
               $extension = request('image')->getClientOriginalExtension();
               $fileName = rand(11111,99999).'.'.$extension; // renaming image
               request('image')->move($destinationPath, $fileName);
               $member->image = $fileName;
           }

          
            $mem=$member->save();

            return response()->json([
                'error' => false,
                'message_key' => 'record_update',
                'message' => 'Record Sucessfully Updated',
                'response'=> $mem,
            ], 200);

        }

        catch (\Throwable $e) {
            return response()->json([
                'error' => true,
                'message' => 'Some Internal Server Error Occured',
                'message_key' => 'internal_error',
                'errors' => $e->getMessage()
            ], 500);
        }
    }
    public function updateThanks(Request $request){
        try{

            
            $validateUser = Validator::make($request->all(), [
                'dataId'=> 'required',
                'name' => 'required',
                'post' => 'required',
                'sorting' => 'required',
                'image' => 'required',

            ]);

           

            
            if($validateUser->fails()) {
                return response()->json([
                    'error' => true,
                    'message' => 'Validation Failed',
                    'message_key' => 'validation_failed',
                    'errors' => $validateUser->errors()
                ], 200);
            }

           
            $member = thanks::find($request->dataId);
            $member->name = request('name');
            $member->post = request('post');
            $member->sorting = request('sorting');
            
            
       
       if ($request->hasFile('image')) {
               $file = array('image' => request('image'));
               $destinationPath = 'images/'; // upload path
               $extension = request('image')->getClientOriginalExtension();
               $fileName = rand(11111,99999).'.'.$extension; // renaming image
               request('image')->move($destinationPath, $fileName);
               $member->image = $fileName;
           }

          
            $mem=$member->save();

            return response()->json([
                'error' => false,
                'message_key' => 'record_update',
                'message' => 'Record Sucessfully Updated',
                'response'=> $mem,
            ], 200);

        }

        catch (\Throwable $e) {
            return response()->json([
                'error' => true,
                'message' => 'Some Internal Server Error Occured',
                'message_key' => 'internal_error',
                'errors' => $e->getMessage()
            ], 500);
        }
    }

    public function deleteMember(Request $request){
        try{

            
            $validateUser = Validator::make($request->all(), [
                'teamsId'=> 'required',

            ]);

           

            
            if($validateUser->fails()) {
                return response()->json([
                    'error' => true,
                    'message' => 'Validation Failed',
                    'message_key' => 'validation_failed',
                    'errors' => $validateUser->errors()
                ], 200);
            }

           
            $mem = teams::find($request->teamsId);
            $image_path = "public/images/".$mem->image;  // Value is not URL but directory file path
            if(File::exists($image_path)) {
                File::delete($image_path);
            }
            $done=$mem->delete();
         
          
           

            return response()->json([
                'error' => false,
                'message_key' => 'record_update',
                'message' => 'Record Sucessfully Deleted',
                'response'=> $done,
            ], 200);

        }

        catch (\Throwable $e) {
            return response()->json([
                'error' => true,
                'message' => 'Some Internal Server Error Occured',
                'message_key' => 'internal_error',
                'errors' => $e->getMessage()
            ], 500);
        }
    }

    public function deleteThanks(Request $request){
        try{

            
            $validateUser = Validator::make($request->all(), [
                'teamsId'=> 'required',

            ]);

           

            
            if($validateUser->fails()) {
                return response()->json([
                    'error' => true,
                    'message' => 'Validation Failed',
                    'message_key' => 'validation_failed',
                    'errors' => $validateUser->errors()
                ], 200);
            }

           
            $mem = thanks::find($request->teamsId);
            $image_path = "public/images/".$mem->image;  // Value is not URL but directory file path
            if(File::exists($image_path)) {
                File::delete($image_path);
            }
            $done=$mem->delete();
         
          
           

            return response()->json([
                'error' => false,
                'message_key' => 'record_update',
                'message' => 'Record Sucessfully Deleted',
                'response'=> $done,
            ], 200);

        }

        catch (\Throwable $e) {
            return response()->json([
                'error' => true,
                'message' => 'Some Internal Server Error Occured',
                'message_key' => 'internal_error',
                'errors' => $e->getMessage()
            ], 500);
        }
    }

    public function getImagesRecord(){
        try {

            $slides = homeslider::all();
            $logos = clientlogos::all();

            return response()->json([
                'error' => false,
                'data' => $slides,
                'data_logos' => $logos,
                'image_path' => '/images/',
            ], 200);

        } catch (\Throwable $e) {
            return response()->json([
                'error' => true,
                'message' => 'Some Internal Server Error Occured',
                'message_key' => 'internal_error',
                'errors' => $e->getMessage()
            ], 500);
        }
    }
    public function deleteSlider(Request $request){
        try{

            
            $validateUser = Validator::make($request->all(), [
                'slidesId'=> 'required',

            ]);

           

            
            if($validateUser->fails()) {
                return response()->json([
                    'error' => true,
                    'message' => 'Validation Failed',
                    'message_key' => 'validation_failed',
                    'errors' => $validateUser->errors()
                ], 200);
            }


            $slider = homeslider::find($request->slidesId);
            $image_path = "public/images/".$slider->image;  // Value is not URL but directory file path
            if(File::exists($image_path)) {
                File::delete($image_path);
            }
            $done=$slider->delete();
         
          
           

            return response()->json([
                'error' => false,
                'message_key' => 'record_update',
                'message' => 'Record Sucessfully Deleted',
                'response'=> $done,
            ], 200);

        }

        catch (\Throwable $e) {
            return response()->json([
                'error' => true,
                'message' => 'Some Internal Server Error Occured',
                'message_key' => 'internal_error',
                'errors' => $e->getMessage()
            ], 500);
        }
    }

    public function deleteLogo(Request $request){
        try{

            
            $validateUser = Validator::make($request->all(), [
                'logosId'=> 'required',

            ]);

           

            
            if($validateUser->fails()) {
                return response()->json([
                    'error' => true,
                    'message' => 'Validation Failed',
                    'message_key' => 'validation_failed',
                    'errors' => $validateUser->errors()
                ], 200);
            }

           
            $logo = clientlogos::find($request->logosId);
            $image_path = "public/images/".$logo->image;  // Value is not URL but directory file path
            if(File::exists($image_path)) {
                File::delete($image_path);
            }
            $done=$logo->delete();
         
          
           

            return response()->json([
                'error' => false,
                'message_key' => 'record_update',
                'message' => 'Record Sucessfully Deleted',
                'response'=> $done,
            ], 200);

        }

        catch (\Throwable $e) {
            return response()->json([
                'error' => true,
                'message' => 'Some Internal Server Error Occured',
                'message_key' => 'internal_error',
                'errors' => $e->getMessage()
            ], 500);
        }
    }

    //------------------------------------------------ Get Involved Page APIS Start-------------------------------------------------//

    public function getInvolvedPageData(){
        try {

            $involved = involved::all();

            return response()->json([
                'error' => false,
                'data' => $involved,
                'image_path' => '/images/',
            ], 200);

        } catch (\Throwable $e) {
            return response()->json([
                'error' => true,
                'message' => 'Some Internal Server Error Occured',
                'message_key' => 'internal_error',
                'errors' => $e->getMessage()
            ], 500);
        }
    }

    public function involvedPageContent(Request $request){
        try{

            
            $validateUser = Validator::make($request->all(), [
                'dataId'=> 'required',
                'heading1' => 'required',
                'heading2' => 'required',
               
               
                'heading3' => 'required',
               
                
                'heading6' => 'required',
                'para5' => 'required',
                'heading7' => 'required',
                'heading8' => 'required',
                'heading9' => 'required',
               

            ]);

           

            
            if($validateUser->fails()) {
                return response()->json([
                    'error' => true,
                    'message' => 'Validation Failed',
                    'message_key' => 'validation_failed',
                    'errors' => $validateUser->errors()
                ], 200);
            }


            $involved = involved::find($request->dataId);
            $involved->heading1 = request('heading1');
            $involved->heading2 = request('heading2');
            $involved->heading3 = request('heading3');
            $involved->heading6 = request('heading6');
            $involved->para5 = request('para5');
            $involved->heading7 = request('heading7');
            $involved->heading8 = request('heading8');
            $involved->heading9 = request('heading9');

           
       
       if ($request->hasFile('image')) {
               $file = array('image' => request('image'));
               $destinationPath = 'images/'; // upload path
               $extension = request('image')->getClientOriginalExtension();
               $fileName = rand(11111,99999).'.'.$extension; // renaming image
               request('image')->move($destinationPath, $fileName);
               $involved->image = $fileName;
           }

         
          
            $involve=$involved->save();

            return response()->json([
                'error' => false,
                'message_key' => 'record_update',
                'message' => 'Record Sucessfully Updated',
                'response'=> $involve,
            ], 200);

        }

        catch (\Throwable $e) {
            return response()->json([
                'error' => true,
                'message' => 'Some Internal Server Error Occured',
                'message_key' => 'internal_error',
                'errors' => $e->getMessage()
            ], 500);
        }
    }

    //------------------------------------------------ Fossil Free Zones Page APIS Start-------------------------------------------------//

    public function getFossilFreeZonesPageData(){
        try {

            $zones = fossilfreezones::all();
            $logos = clientlogos::all();
            $faqs = faqs::all();
            $rules = rules::all();

            return response()->json([
                'error' => false,
                'data' => $zones,
                'data_images' => $logos,
                'data_faqs' => $faqs,
                'data_rules' => $rules,
                'image_path' => '/images/',
            ], 200);

        } catch (\Throwable $e) {
            return response()->json([
                'error' => true,
                'message' => 'Some Internal Server Error Occured',
                'message_key' => 'internal_error',
                'errors' => $e->getMessage()
            ], 500);
        }
    }

    public function fossilFreeZonesPageContent(Request $request){
        try{

            
            $validateUser = Validator::make($request->all(), [
                'dataId'=> 'required',
                'heading1' => 'required',
                'heading2' => 'required',
                'para1' => 'required',
                'para2' => 'required',
                'heading3' => 'required',
                'para3' => 'required',
                'heading4' => 'required',
                'heading5' => 'required',
                'para4' => 'required',
                'oimage' => 'required',
                'limage' => 'required',

            ]);

           

            
            if($validateUser->fails()) {
                return response()->json([
                    'error' => true,
                    'message' => 'Validation Failed',
                    'message_key' => 'validation_failed',
                    'errors' => $validateUser->errors()
                ], 200);
            }


            $zones = fossilfreezones::find($request->dataId);
            $zones->heading1 = request('heading1');
            $zones->heading2 = request('heading2');
            $zones->para1 = request('para1');
            $zones->para2 = request('para2');
            $zones->heading3 = request('heading3');
            $zones->para3 = request('para3');
            $zones->heading4 = request('heading4');
            $zones->heading5 = request('heading5');
            $zones->para4 = request('para4');
            

            request()->validate([
                
                'oimage' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:10000',
                'limage' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:10000',
            ]);
       
       if ($request->hasFile('oimage')) {
               $file = array('oimage' => request('oimage'));
               $destinationPath = 'images/'; // upload path
               $extension = request('oimage')->getClientOriginalExtension();
               $fileName = rand(11111,99999).'.'.$extension; // renaming image
               request('oimage')->move($destinationPath, $fileName);
               $zones->oimage = $fileName;
           }

           if ($request->hasFile('limage')) {
            $file = array('limage' => request('limage'));
            $destinationPath = 'images/'; // upload path
            $extension = request('limage')->getClientOriginalExtension();
            $fileName = rand(11111,99999).'.'.$extension; // renaming image
            request('limage')->move($destinationPath, $fileName);
            $zones->limage = $fileName;
        }

         
          
            $zone=$zones->save();

            return response()->json([
                'error' => false,
                'message_key' => 'record_update',
                'message' => 'Record Sucessfully Updated',
                'response'=> $zone,
            ], 200);

        }

        catch (\Throwable $e) {
            return response()->json([
                'error' => true,
                'message' => 'Some Internal Server Error Occured',
                'message_key' => 'internal_error',
                'errors' => $e->getMessage()
            ], 500);
        }
    }

    //------------------------------------------------ FAQ's Page APIS Start-------------------------------------------------//

    public function addFaqs(Request $request){
        try{
            $validateUser = Validator::make($request->all(), [
                'title' => 'required',
                'details' => 'required',
                
              

            ]);

            if($validateUser->fails()) {
                return response()->json([
                    'error' => true,
                    'message' => 'Validation Failed',
                    'message_key' => 'validation_failed',
                    'errors' => $validateUser->errors()
                ], 200);
            }

            $faqs = new faqs();
            $faqs->title = request('title');
            $faqs->details = request('details');
            

            $faq=$faqs->save();

            return response()->json([
                'error' => false,
                'message_key' => 'record_update',
                'message' => 'Record Sucessfully Inserted',
                'response'=> $faq,
            ], 200);

        }

        catch (\Throwable $e) {
            return response()->json([
                'error' => true,
                'message' => 'Some Internal Server Error Occured',
                'message_key' => 'internal_error',
                'errors' => $e->getMessage()
            ], 500);
        }
    }

    public function getFaqsRecord(){
        try {

            $faqs = faqs::all();
           
            return response()->json([
                'error' => false,
                'data' => $faqs,
            ], 200);

        } catch (\Throwable $e) {
            return response()->json([
                'error' => true,
                'message' => 'Some Internal Server Error Occured',
                'message_key' => 'internal_error',
                'errors' => $e->getMessage()
            ], 500);
        }
    }

    public function deleteFaqs(Request $request){
        try{

            
            $validateUser = Validator::make($request->all(), [
                'faqsId'=> 'required',

            ]);

           

            
            if($validateUser->fails()) {
                return response()->json([
                    'error' => true,
                    'message' => 'Validation Failed',
                    'message_key' => 'validation_failed',
                    'errors' => $validateUser->errors()
                ], 200);
            }

           
            $faq = faqs::find($request->faqsId);
            $done=$faq->delete();
         
          
           

            return response()->json([
                'error' => false,
                'message_key' => 'record_update',
                'message' => 'Record Sucessfully Deleted',
                'response'=> $done,
            ], 200);

        }

        catch (\Throwable $e) {
            return response()->json([
                'error' => true,
                'message' => 'Some Internal Server Error Occured',
                'message_key' => 'internal_error',
                'errors' => $e->getMessage()
            ], 500);
        }
    }

    public function updateFaqs(Request $request){
        try{

            
            $validateUser = Validator::make($request->all(), [
                'dataId'=> 'required',
                'title' => 'required',
                'details' => 'required',

            ]);

           

            
            if($validateUser->fails()) {
                return response()->json([
                    'error' => true,
                    'message' => 'Validation Failed',
                    'message_key' => 'validation_failed',
                    'errors' => $validateUser->errors()
                ], 200);
            }

           
            $faqs = faqs::find($request->dataId);
            $faqs->title = request('title');
            $faqs->details = request('details');

          
            $faq=$faqs->save();

            return response()->json([
                'error' => false,
                'message_key' => 'record_update',
                'message' => 'Record Sucessfully Updated',
                'response'=> $faq,
            ], 200);

        }

        catch (\Throwable $e) {
            return response()->json([
                'error' => true,
                'message' => 'Some Internal Server Error Occured',
                'message_key' => 'internal_error',
                'errors' => $e->getMessage()
            ], 500);
        }
    }

    //------------------------------------------------ Contact Us Page APIS Start-------------------------------------------------//

    public function getContactPageData(){
        try {

            $data = contactus::all();
        
            return response()->json([
                'error' => false,
                'data' => $data,
                
            ], 200);

        } catch (\Throwable $e) {
            return response()->json([
                'error' => true,
                'message' => 'Some Internal Server Error Occured',
                'message_key' => 'internal_error',
                'errors' => $e->getMessage()
            ], 500);
        }
    }

    public function contactPageContent(Request $request){
        try{

            
            $validateUser = Validator::make($request->all(), [
                'dataId'=> 'required',
                'heading1' => 'required',
                'heading2' => 'required',
                'heading3' => 'required',
                'heading4' => 'required',
                'para1' => 'required',
                'para2' => 'required',
                'para3' => 'required',
                'para4' => 'required',
                'number' => 'required',
                'email' => 'required',
                'address' => 'required',

            ]);
    
            if($validateUser->fails()) {
                return response()->json([
                    'error' => true,
                    'message' => 'Validation Failed',
                    'message_key' => 'validation_failed',
                    'errors' => $validateUser->errors()
                ], 200);
            }


            $data = contactus::find($request->dataId);
            $data->heading1 = request('heading1');
            $data->heading2 = request('heading2');
            $data->heading3 = request('heading3');
            $data->heading4 = request('heading4');
            $data->para1 = request('para1');
            $data->para2 = request('para2');
            $data->para3 = request('para3');
            $data->para4 = request('para4');
            $data->number = request('number');
            $data->email = request('email');
            $data->address = request('address');
            

            $home=$data->save();

            return response()->json([
                'error' => false,
                'message_key' => 'record_update',
                'message' => 'Record Sucessfully Updated',
                'response'=> $home,
            ], 200);

        }

        catch (\Throwable $e) {
            return response()->json([
                'error' => true,
                'message' => 'Some Internal Server Error Occured',
                'message_key' => 'internal_error',
                'errors' => $e->getMessage()
            ], 500);
        }
    }

    public function submitContactForm(Request $request){
        try{



            

            $validateUser = Validator::make($request->all(), [
                'formName' => 'required',
                'formEmail' => 'required',
                'formMessage' => 'required',
                
              

            ]);

            if($validateUser->fails()) {
                return response()->json([
                    'error' => true,
                    'message' => 'Validation Failed',
                    'message_key' => 'validation_failed',
                    'errors' => $validateUser->errors()
                ], 200);
            }
            $cmessage = ctemplate::get(['message']);
            $form = new contactform();
            $form->name = request('formName');
            $form->email = request('formEmail');
            $form->message = request('formMessage');
            $form->cmessage = $cmessage;
            Mail::to($request->formEmail)->send(new SendContactFormMail($form));
            $form->save();

            return response()->json([
                'error' => false,
                'message_key' => 'record_update',
                'message' => 'Record Sucessfully Inserted',
                'response'=> $form,
               
            ], 200);

        }

        catch (\Throwable $e) {
            return response()->json([
                'error' => true,
                'message' => 'Some Internal Server Error Occured',
                'message_key' => 'internal_error',
                'errors' => $e->getMessage()
            ], 500);
        }
    }

    public function getContactData(){
        try {

            $data = contactform::all();
        
            return response()->json([
                'error' => false,
                'data' => $data,
                
            ], 200);

        } catch (\Throwable $e) {
            return response()->json([
                'error' => true,
                'message' => 'Some Internal Server Error Occured',
                'message_key' => 'internal_error',
                'errors' => $e->getMessage()
            ], 500);
        }
    }

    public function deleteCForm(Request $request){
        try{

            
            $validateUser = Validator::make($request->all(), [
                'formId'=> 'required',

            ]);


            if($validateUser->fails()) {
                return response()->json([
                    'error' => true,
                    'message' => 'Validation Failed',
                    'message_key' => 'validation_failed',
                    'errors' => $validateUser->errors()
                ], 200);
            }

           
            $form = contactform::find($request->formId);
            $done=$form->delete();

            return response()->json([
                'error' => false,
                'message_key' => 'record_update',
                'message' => 'Record Sucessfully Deleted',
                'response'=> $done,
            ], 200);

        }

        catch (\Throwable $e) {
            return response()->json([
                'error' => true,
                'message' => 'Some Internal Server Error Occured',
                'message_key' => 'internal_error',
                'errors' => $e->getMessage()
            ], 500);
        }
    }

    public function submitZonesForm(Request $request){
        try{
            $validateUser = Validator::make($request->all(), [
                'formName' => 'required',
                'formEmail' => 'required',
                'formPlace' => 'required',
                'formSite' => 'required',
                'formCountry' => 'required',

            ]);

            if($validateUser->fails()) {
                return response()->json([
                    'error' => true,
                    'message' => 'Validation Failed',
                    'message_key' => 'validation_failed',
                    'errors' => $validateUser->errors()
                ], 200);
            }
            $zmessage = ztemplate::get(['message']);
            $form = new zonesform();
            $form->name = request('formName');
            $form->email = request('formEmail');
            $form->place = request('formPlace');
            $form->site = request('formSite');
            $form->country = request('formCountry');
            $form->zmessage = $zmessage;

            Mail::to($request->formEmail)->send(new SendZonesFormMail($form));

            $form->save();

            return response()->json([
                'error' => false,
                'message_key' => 'record_update',
                'message' => 'Record Sucessfully Inserted',
                'response'=> $form,
            ], 200);

        }

        catch (\Throwable $e) {
            return response()->json([
                'error' => true,
                'message' => 'Some Internal Server Error Occured',
                'message_key' => 'internal_error',
                'errors' => $e->getMessage()
            ], 500);
        }
    }
    
    //------------------------------------------------ Rules Management APIS Start-------------------------------------------------//

    public function addRules(Request $request){
        try{
            $validateUser = Validator::make($request->all(), [
                'title1' => 'required',
                'title2' => 'required',
                'description' => 'required',
                'rules1' => 'required',
                'rules2' => 'required',
                'image' => 'required',

            ]);

            if($validateUser->fails()) {
                return response()->json([
                    'error' => true,
                    'message' => 'Validation Failed',
                    'message_key' => 'validation_failed',
                    'errors' => $validateUser->errors()
                ], 200);
            }

            $rules = new rules();
           
            $rules->description = request('description');
            $rules->rules1 = request('rules1');
            $rules->rules2 = request('rules2');
            

            request()->validate([
                'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:10000',
                'title1' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:10000',
                'title2' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:10000',
            ]);
       
       if ($request->hasFile('image')) {
               $file = array('image' => request('image'));
               $destinationPath = 'images/'; // upload path
               $extension = request('image')->getClientOriginalExtension();
               $fileName = rand(11111,99999).'.'.$extension; // renaming image
               request('image')->move($destinationPath, $fileName);
               $rules->image = $fileName;
           }

           if ($request->hasFile('title1')) {
            $file = array('title1' => request('title1'));
            $destinationPath = 'images/'; // upload path
            $extension = request('title1')->getClientOriginalExtension();
            $fileName = rand(11111,99999).'.'.$extension; // renaming image
            request('title1')->move($destinationPath, $fileName);
            $rules->title1 = $fileName;
        }

        if ($request->hasFile('title2')) {
            $file = array('title2' => request('title2'));
            $destinationPath = 'images/'; // upload path
            $extension = request('title2')->getClientOriginalExtension();
            $fileName = rand(11111,99999).'.'.$extension; // renaming image
            request('title2')->move($destinationPath, $fileName);
            $rules->title2 = $fileName;
        }
          

            $rule=$rules->save();

            return response()->json([
                'error' => false,
                'message_key' => 'record_update',
                'message' => 'Record Sucessfully Inserted',
                'response'=> $rule,
            ], 200);

        }

        catch (\Throwable $e) {
            return response()->json([
                'error' => true,
                'message' => 'Some Internal Server Error Occured',
                'message_key' => 'internal_error',
                'errors' => $e->getMessage()
            ], 500);
        }
    }

    public function getRulesRecord(){
        try {

            $rules = rules::all();
           
            return response()->json([
                'error' => false,
                'data' => $rules,
                'image_path' => '/images/',
            ], 200);

        } catch (\Throwable $e) {
            return response()->json([
                'error' => true,
                'message' => 'Some Internal Server Error Occured',
                'message_key' => 'internal_error',
                'errors' => $e->getMessage()
            ], 500);
        }
    }

    public function updateRules(Request $request){
        try{

            
            $validateUser = Validator::make($request->all(), [
                'dataId'=> 'required',
                'title1' => 'required',
                'title2' => 'required',
                'rules1' => 'required',
                'rules2' => 'required',
                'description' => 'required',
                'image' => 'required',

            ]);

           

            
            if($validateUser->fails()) {
                return response()->json([
                    'error' => true,
                    'message' => 'Validation Failed',
                    'message_key' => 'validation_failed',
                    'errors' => $validateUser->errors()
                ], 200);
            }

           
            $rules = rules::find($request->dataId);
            $rules->rules1 = request('rules1');
            $rules->rules2 = request('rules2');
            $rules->description = request('description');
            
            
       
       if ($request->hasFile('image')) {
               $file = array('image' => request('image'));
               $destinationPath = 'images/'; // upload path
               $extension = request('image')->getClientOriginalExtension();
               $fileName = rand(11111,99999).'.'.$extension; // renaming image
               request('image')->move($destinationPath, $fileName);
               $rules->image = $fileName;
           }

           if ($request->hasFile('title1')) {
            $file = array('title1' => request('title1'));
            $destinationPath = 'images/'; // upload path
            $extension = request('title1')->getClientOriginalExtension();
            $fileName = rand(11111,99999).'.'.$extension; // renaming image
            request('title1')->move($destinationPath, $fileName);
            $rules->title1 = $fileName;
        }

        if ($request->hasFile('title2')) {
            $file = array('title2' => request('title2'));
            $destinationPath = 'images/'; // upload path
            $extension = request('title2')->getClientOriginalExtension();
            $fileName = rand(11111,99999).'.'.$extension; // renaming image
            request('title2')->move($destinationPath, $fileName);
            $rules->title2 = $fileName;
        }
          

          
            $rule=$rules->save();

            return response()->json([
                'error' => false,
                'message_key' => 'record_update',
                'message' => 'Record Sucessfully Updated',
                'response'=> $rule,
            ], 200);

        }

        catch (\Throwable $e) {
            return response()->json([
                'error' => true,
                'message' => 'Some Internal Server Error Occured',
                'message_key' => 'internal_error',
                'errors' => $e->getMessage()
            ], 500);
        }
    }

    public function deleteRules(Request $request){
        try{

            
            $validateUser = Validator::make($request->all(), [
                'rulesId'=> 'required',

            ]);


            if($validateUser->fails()) {
                return response()->json([
                    'error' => true,
                    'message' => 'Validation Failed',
                    'message_key' => 'validation_failed',
                    'errors' => $validateUser->errors()
                ], 200);
            }

           
            $rule = rules::find($request->rulesId);
            $done=$rule->delete();

            return response()->json([
                'error' => false,
                'message_key' => 'record_update',
                'message' => 'Record Sucessfully Deleted',
                'response'=> $done,
            ], 200);

        }

        catch (\Throwable $e) {
            return response()->json([
                'error' => true,
                'message' => 'Some Internal Server Error Occured',
                'message_key' => 'internal_error',
                'errors' => $e->getMessage()
            ], 500);
        }
    }

    public function getZonesData(){
        try {

                $userDetails = auth()->user();
                if($userDetails->country == null || $userDetails->country == ''){
                    $data = zonesform::all();
                }else{
                    $data = zonesform::where('country','=', $userDetails->country)->get();
                }
               
           
            
        
            return response()->json([
                'error' => false,
                'data' => $data,
            
                
            ], 200);

        } catch (\Throwable $e) {
            return response()->json([
                'error' => true,
                'message' => 'Some Internal Server Error Occured',
                'message_key' => 'internal_error',
                'errors' => $e->getMessage()
            ], 500);
        }
    }

    public function deleteZForm(Request $request){
        try{

            
            $validateUser = Validator::make($request->all(), [
                'formId'=> 'required',

            ]);


            if($validateUser->fails()) {
                return response()->json([
                    'error' => true,
                    'message' => 'Validation Failed',
                    'message_key' => 'validation_failed',
                    'errors' => $validateUser->errors()
                ], 200);
            }

           
            $form = zonesform::find($request->formId);
            $done=$form->delete();

            return response()->json([
                'error' => false,
                'message_key' => 'record_update',
                'message' => 'Record Sucessfully Deleted',
                'response'=> $done,
            ], 200);

        }

        catch (\Throwable $e) {
            return response()->json([
                'error' => true,
                'message' => 'Some Internal Server Error Occured',
                'message_key' => 'internal_error',
                'errors' => $e->getMessage()
            ], 500);
        }
    }

    public function downloadFile(Request $request) {

        try{

            
            $validateUser = Validator::make($request->all(), [
                'bookName'=> 'required',

            ]);


            if($validateUser->fails()) {
                return response()->json([
                    'error' => true,
                    'message' => 'Validation Failed',
                    'message_key' => 'validation_failed',
                    'errors' => $validateUser->errors()
                ], 200);
            }

           
            $done = public_path('images/'.$request->bookName);
            $filePath = '/images/'.$request->bookName;
            

            return response()->json([
                'error' => false,
                'message_key' => 'record_update',
                'message' => 'File Downloading',
                // 'response'=> response()->download($done),
                'file_path'=> $filePath,
                'file_name'=> $request->bookName,
            ], 200);

        }

        catch (\Throwable $e) {
            return response()->json([
                'error' => true,
                'message' => 'Some Internal Server Error Occured',
                'message_key' => 'internal_error',
                'errors' => $e->getMessage()
            ], 500);
        }
    }

    public function getFooterData(){
        try {

            $data = footer::all();
           
            return response()->json([
                'error' => false,
                'data' => $data,
                'image_path' => '/images/',
            ], 200);

        } catch (\Throwable $e) {
            return response()->json([
                'error' => true,
                'message' => 'Some Internal Server Error Occured',
                'message_key' => 'internal_error',
                'errors' => $e->getMessage()
            ], 500);
        }
    }

    public function updateFooter(Request $request){
        try{

            
            $validateUser = Validator::make($request->all(), [
                'dataId'=> 'required',
                'number' => 'required',
                'footermail' => 'required',
                'message' => 'required',

            ]);

           

            
            if($validateUser->fails()) {
                return response()->json([
                    'error' => true,
                    'message' => 'Validation Failed',
                    'message_key' => 'validation_failed',
                    'errors' => $validateUser->errors()
                ], 200);
            }

           
            $data = footer::find($request->dataId);
            $data->number = request('number');
            $data->footermail = request('footermail');
            $data->message = request('message');
            $data->facebook = request('facebook');
            $data->instagram = request('instagram');
            $data->linkedin = request('linkedin');
            $data->linkicon = request('linkicon');
            $data->twitter = request('twitter');
            $data->face = request('face');
            $data->insta = request('insta');
            $data->twit = request('twit');
            

          
            $dat=$data->save();

            return response()->json([
                'error' => false,
                'message_key' => 'record_update',
                'message' => 'Record Sucessfully Updated',
                'response'=> $dat,
            ], 200);

        }

        catch (\Throwable $e) {
            return response()->json([
                'error' => true,
                'message' => 'Some Internal Server Error Occured',
                'message_key' => 'internal_error',
                'errors' => $e->getMessage()
            ], 500);
        }
    }

    public function getCtemplate(){
        try {

            $data = ctemplate::all();
           
            return response()->json([
                'error' => false,
                'data' => $data,            
            ], 200);

        } catch (\Throwable $e) {
            return response()->json([
                'error' => true,
                'message' => 'Some Internal Server Error Occured',
                'message_key' => 'internal_error',
                'errors' => $e->getMessage()
            ], 500);
        }
    }

    public function updateCtemplate(Request $request){
        try{

            
            $validateUser = Validator::make($request->all(), [
                'dataId'=> 'required',
                'message' => 'required',
                

            ]);

           

            
            if($validateUser->fails()) {
                return response()->json([
                    'error' => true,
                    'message' => 'Validation Failed',
                    'message_key' => 'validation_failed',
                    'errors' => $validateUser->errors()
                ], 200);
            }

           
            $data = ctemplate::find($request->dataId);
            $data->message = request('message');

            $dat=$data->save();

            return response()->json([
                'error' => false,
                'message_key' => 'record_update',
                'message' => 'Record Sucessfully Updated',
                'response'=> $dat,
            ], 200);

        }

        catch (\Throwable $e) {
            return response()->json([
                'error' => true,
                'message' => 'Some Internal Server Error Occured',
                'message_key' => 'internal_error',
                'errors' => $e->getMessage()
            ], 500);
        }
    }

    public function getZtemplate(){
        try {

            $data = ztemplate::all();
           
            return response()->json([
                'error' => false,
                'data' => $data,            
            ], 200);

        } catch (\Throwable $e) {
            return response()->json([
                'error' => true,
                'message' => 'Some Internal Server Error Occured',
                'message_key' => 'internal_error',
                'errors' => $e->getMessage()
            ], 500);
        }
    }

    public function updateZtemplate(Request $request){
        try{

            
            $validateUser = Validator::make($request->all(), [
                'dataId'=> 'required',
                'message' => 'required',
                

            ]);

           

            
            if($validateUser->fails()) {
                return response()->json([
                    'error' => true,
                    'message' => 'Validation Failed',
                    'message_key' => 'validation_failed',
                    'errors' => $validateUser->errors()
                ], 200);
            }

           
            $data = ztemplate::find($request->dataId);
            $data->message = request('message');

            $dat=$data->save();

            return response()->json([
                'error' => false,
                'message_key' => 'record_update',
                'message' => 'Record Sucessfully Updated',
                'response'=> $dat,
            ], 200);

        }

        catch (\Throwable $e) {
            return response()->json([
                'error' => true,
                'message' => 'Some Internal Server Error Occured',
                'message_key' => 'internal_error',
                'errors' => $e->getMessage()
            ], 500);
        }
    } 

    public function downloadFileNew(Request $request){
        try {


            $validateUser = Validator::make($request->all(), [
                'fileName'=> 'required',

            ]);


            if($validateUser->fails()) {
                return response()->json([
                    'error' => true,
                    'message' => 'Validation Failed',
                    'message_key' => 'validation_failed',
                    'errors' => $validateUser->errors()
                ], 200);
            }

                // $filepath = public_path('images/50439.pdf');
                // $file = Response::download($filepath); 

                     $data = cases::where('pdf','=', $request->fileName)->get(['pdf']);
                     $downloadable = Response::download($data, ['Content-Type: application/pdf']);

        
            return response()->json([
                'error' => false,
                'data' => $file,
                
            ], 200);

        } catch (\Throwable $e) {
            return response()->json([
                'error' => true,
                'message' => 'Some Internal Server Error Occured',
                'message_key' => 'internal_error',
                'errors' => $e->getMessage()
            ], 500);
        }
    }

}
