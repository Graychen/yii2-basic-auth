<?php
namespace graychen\yii2\basic\auth\filters;

use yii\filters\auth\HttpBasicAuth as BasicAuth;

/**
 * Class HttpBasicAuth
 * @package app\filters\auth
 */
class HttpBasicAuth extends BasicAuth
{
    /**
     * @inheritdoc
     */
    public function authenticate($user, $request, $response)
    {
        $username = empty($request->getAuthUser()) ? $request->get('x_app_key') : $request->getAuthUser();
        $password = empty($request->getAuthPassword()) ? $request->get('x_app_secret') : $request->getAuthPassword();
        if ($this->auth) {
            if ($username !== null || $password !== null) {
                $identity = call_user_func($this->auth, $username, $password);
                if ($identity !== null) {
                    $user->switchIdentity($identity);
                } else {
                    $this->handleFailure($response);
                }
                return $identity;
            }
        } elseif ($username !== null) {
            $identity = $user->loginByAccessToken($username, get_class($this));
            if ($identity === null) {
                $this->handleFailure($response);
            }
            return $identity;
        }
        return null;
    }
}
