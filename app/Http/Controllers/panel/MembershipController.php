<?php

namespace App\Http\Controllers\panel;

use App\Http\Controllers\Controller;
use App\Http\Helpers\panel\CustomerHelper;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;

class MembershipController extends Controller
{
    protected $helper;
    public function __construct(CustomerHelper $helper)
    {
        $this->middleware(['auth', 'CheckAdmin']);
        $this->helper = $helper;
    }

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $pageinfo = [
            'title' => __('Membership Request'),
            'description' => 'description',
            'keywords' => 'keywords',
            'owner' => 'owner',
            'breadcrumbs' => [
                ['Home', __('Customers'), __('Membership Request')],
                ['dashboard.index', 'customer.panel', 'membership.panel']
            ],
        ];

        return view('panel.membership', compact('pageinfo'));
    }

    public function indexJson(Request $request)
    {

        $users = $this->helper->inactiveUsers();

        return response()->json($users);
    }

    /**
     * Display the specified resource.
     */
    public function show(User $user)
    {
        $pageinfo = [
            'title' => __('Membership Request'),
            'description' => 'description',
            'keywords' => 'keywords',
            'owner' => 'owner',
            'breadcrumbs' => [
                ['Home', __('Customers'), __('Membership Request'), __('Details')],
                ['dashboard.index', 'customer.panel', 'membership.panel', 'membership.show']
            ],
        ];
        $user['customergroup'] = $user->customergroups()->pluck('name','slug')->toArray();
        return view('panel.membership-detail', compact('pageinfo', 'user'));
    }

    public function update(Request $request, User $user)
    {

        $user->update(['status' => (int) $request->input('status')]);

        if ($request->input('ajax'))
            return response()->json(['type'=>'success','code'=>200,'message' => 'success','data'=>[]]);
        else
            return redirect()->route('membership.panel')->with('success', __('The action was executed successfully.'));
    }

    public function destroy(Request $request, User $user)
    {
            $user->delete();

        if ($request->input('ajax'))
            return response()->json(['type'=>'success','code'=>200,'message' => 'success','data'=>[]]);
        else
            return redirect()->route('membership.panel')->with('success', __('The action was executed successfully.'));
    }
}
