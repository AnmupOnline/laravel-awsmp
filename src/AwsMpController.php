<?php

namespace Anmup\LaravelAwsMp;

use GuzzleHttp\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Middleware\VerifyCsrfToken;
use Illuminate\Routing\Controller;


class AwsMpController extends Controller
{

    /**
     * @var register_path
     */
    protected $register_path = 'register';

    /**
     * @var redirectTo
     */
    protected $redirectTo = '/home';

    protected function resolve()
    {
        return redirect($this->redirectTo);
    }

    public function handle(Request $request)
    {
        /** Redirect AWS POST request to Register Page */
        $token = $request->post('x-amzn-marketplace-token');

        if($token) {
            
            return redirect("$this->register_path?x-amzn-marketplace-token={$token}");
        }

        /** Handle Request from Register Page */
        $token = $request->get('x-amzn-marketplace-token');

        if($this->getEntitlement($token))
            $this->register($request);
        
        return $this->resolve();
    }

    protected function getEntitlement($token) 
    {
        
        $url = config('awsmp.resolve-customer-url');

        $client = new Client([
            'headers' => ['Content-Type' => 'application/json']
        ]);

        $data = [
            'regToken' => $token
        ];
        
        try {

            $req = $client->post($url, ['body' => json_encode($data)]);
            $response = json_decode($req->getBody()->getContents());

            dd($response, $token);
        } catch (Execption $e) {
            dd($e, $token);
        }
        
    }

    // Register user from aws
    public function register(Request $request)
    {
       
        // this should be overridden

        return $this->resolve();
    }
}
