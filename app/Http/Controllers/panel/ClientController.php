<?php

namespace App\Http\Controllers\panel;

use App\Http\Controllers\Controller;
use Illuminate\Validation\Rule;
use Laravel\Passport\Client;
use Laravel\Passport\Passport;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Exception;

class ClientController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth', 'CheckAdmin']);
    }

    /**
     * Display the index page.
     *
     * @return \Illuminate\Contracts\View\View
     */
    public function index()
    {
        // Page information for the view
        $pageinfo = [
            'title' => __('Users'),
            'description' => 'description',
            'keywords' => 'keywords',
            'owner' => 'owner',
            'breadcrumbs' => [
                ['Home', __('Authentication'), __('Users')],
                ['dashboard.index', 'client.panel', 'client.panel']
            ],
        ];

        return view('panel.client', compact('pageinfo'));
    }

    /**
     * Return the list of clients in JSON format.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function indexJson()
    {
        $clients = Passport::client()->orderBy('name', 'asc')->get()->values();

        $clients->makeVisible('secret');
        return response()->json($clients);
    }

    /**
     * Display the edit form for a client.
     *
     * @param  \Laravel\Passport\Client $client
     * @return \Illuminate\Http\JsonResponse
     */
    public function edit(Client $client)
    {
        return response()->json($client);
    }

    /**
     * Store a new client.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        // Validation rules for the request
        $rules = [
            'name' => 'required|string|min:3|max:191|unique:oauth_clients,name',
            'redirect' => 'required|url',
        ];
        $validator = $request->validate($rules);
        $data = $validator;
        try {
            // Create a new client instance
            $client = Passport::client()->forceFill([
                'user_id' => null,
                'name' => $data['name'],
                'secret' => Str::random(40),
                'provider' => null,
                'redirect' => $data['redirect'],
                'personal_access_client' => false,
                'password_client' => true,
                'revoked' => false,
            ]);

            $client->save();

            return redirect()->route('client.panel')->with('success', __('The action was executed successfully.'));
        } catch (Exception $e) {
            return redirect()->route('client.panel')->with('warning', __('An unexpected error occurred and we have notified our support team. Please try again later.'))->withInput();
        }
    }

    /**
     * Update an existing client.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \Laravel\Passport\Client $client
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, Client $client)
    {
        // Validation rules for the request
        $rules = [
            'name' => ['required','string','min:3','max:191',Rule::unique('oauth_clients', 'name')->ignore($client->id)],
            'redirect' => 'required|string',
        ];
        $validator = $request->validate($rules);

        try {
            $client->update($validator);
            return redirect()->route('client.panel')->with('success', __('The action was executed successfully.'));
        } catch (Exception $e) {
            return redirect()->route('client.panel')->with('warning', __('An unexpected error occurred and we have notified our support team. Please try again later.'))->withInput();
        }
    }

    /**
     * Delete a client.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \Laravel\Passport\Client $client
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy(Request $request, Client $client)
    {
        $client->tokens()->delete();

        $client->delete();

        return response()->json(['type' => 'success', 'code' => 200, 'message' => 'success', 'data' => []]);
    }

    /**
     * Revoke the access of a client.
     *
     * @param  \Laravel\Passport\Client $client
     * @return \Illuminate\Http\JsonResponse
     */
    public function revoke(Client $client)
    {
        $client->tokens()->update(['revoked' => true]);

        $client->forceFill(['revoked' => true])->save();
        return response()->json(['type' => 'success', 'code' => 200, 'message' => 'success', 'data' => []]);
    }

    /**
     * Grant access to a client.
     *
     * @param  \Laravel\Passport\Client $client
     * @return \Illuminate\Http\JsonResponse
     */
    public function access(Client $client)
    {
        $client->tokens()->update(['revoked' => false]);

        $client->forceFill(['revoked' => false])->save();
        return response()->json(['type' => 'success', 'code' => 200, 'message' => 'success', 'data' => []]);
    }
}
