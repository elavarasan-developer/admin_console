<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Laravel\Socialite\Facades\Socialite;
use Illuminate\Support\Str;

class GoogleAuthController extends Controller
{
    // If you have a browser/SPA, this redirects the user to Google
    public function redirect()
    {
        // Use stateless() if you’re fully API-only without sessions
        return Socialite::driver('google')->stateless()->redirect();
    }

    // Google will hit this callback; we’ll create/find user and issue a Sanctum token
    public function callback(Request $request)
    {
        $googleUser = Socialite::driver('google')->stateless()->user();

        $user = User::updateOrCreate(
            ['google_id' => $googleUser->getId()],
            [
                'name'  => $googleUser->getName() ?: $googleUser->getNickname() ?: 'Google User',
                'email' => $googleUser->getEmail(), // may be null if not shared
                'avatar' => $googleUser->getAvatar(),
                // In case user signs in with Google first, set a random password
                'password' => bcrypt(Str::random(32)),
            ]
        );

        $token = $user->createToken('google')->plainTextToken;

        // For SPA/mobile, you typically redirect back to your frontend with the token
        // e.g. https://your-frontend-app/callback?token=...
        return response()->json([
            'user'  => $user,
            'token' => $token,
            'token_type' => 'Bearer',
        ]);
    }

    /**
     * Alternative flow (mobile/SPA): exchange a Google ID token from client.
     * Client signs in with Google, sends id_token here, we verify via Socialite.
     */
    public function loginWithIdToken(Request $request)
    {
        $data = $request->validate([
            'id_token'    => ['required', 'string'],
            'device_name' => ['nullable', 'string', 'max:100'],
        ]);

        // Socialite Google doesn't natively verify ID tokens; in production,
        // verify id_token with Google public keys (e.g., firebase/php-jwt or Google API PHP Client).
        // For brevity, this is a placeholder:
        // $payload = verifyGoogleIdToken($data['id_token']);

        return response()->json([
            'message' => 'Implement ID token verification if you need this path.',
        ], 501);
    }
}
