<?php

namespace App\Http\Controllers;
use App\Cruise;
use Illuminate\Http\Request;
use DateTime;
use App\Http\Requests;
use App\Http\Controllers\Controller;

class CruiseController extends Controller
{
    //
    /**
     * Create new controller instance.
     *
     */
    public function __construct()
    {
    	$this->middleware('auth');
    }

    public function getCruiseList()
    {
    	return view('admin.cruises');
    }

    public function getCruiseForm()
    {
    	return view('admin.cruise');
    }

    public function getUpdateCruiseForm(Request $request, Cruise $cruise)
    {
    	$data = array(
    		'cruise' => $cruise
    		);
    	return view('admin.editcruise', $data);
    }

    public function deleteCruise(Request $request, Cruise $cruise)
    {
        $this->authorize('destroy', $cruise);

        $cruise->delete();

        return redirect('/cruises');
    }
    public function postNewCruise(Request $request)
    {
    	$this->validate($request, [
    		'name' => 'required|max:50',
    		'price' => 'required|alpha_num',
    		'depart_location' => 'required',
    		'arrive_location' => 'required',
    		'route_date' => 'required|max:23',
    		]);
    	$dates = explode(" - ", $request->route_date);
    	$depart = DateTime::createFromFormat('m/d/Y', $dates[0])->format('Y-m-d');
    	$arrive = DateTime::createFromFormat('m/d/Y', $dates[1])->format('Y-m-d');
    	?>
    	<script>alert('<?php echo $request->description;?>');</script>
    	<?php
    	 $cruise = Cruise::create([
    		'name' => $request->name,
    		'price' => $request->price,
    		'depart_location' => $request->depart_location,
    		'arrive_location' => $request->arrive_location,
    		'description' => $request->description,
    		'type' => $request->type,
    		'depart_date' => $depart,
    		'arrive_date' => $arrive,
    		]);

    	return redirect('/admin/cruise/' . $cruise->id);
    }
}
