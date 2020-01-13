<?php declare(strict_types = 1);

namespace RamosHenrique\reCaptchaMiddleware;

use Closure;

use Illuminate\Http\{
    Response,
    Request
};

use ReCaptcha\ReCaptcha;

class Middleware
{
    public const HTML_RESPONSE_TYPE = 'html';
    public const JSON_RESPONSE_TYPE = 'json';

    /**
     * Handle an incoming request.
     *
     * @param Request $request
     * @param Closure $next
     *
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        $gRecaptchaResponse = $request->input('g-recaptcha-response');
        $remoteIp = $request->ip();

        $recaptcha = new ReCaptcha(config('recaptcha_middleware.secret_key'));
        $resp = $recaptcha->verify($gRecaptchaResponse, $remoteIp);
        if ($resp->isSuccess()) {
            return $next($request);
        }

        return $this->handleWrongResponse($resp->getErrorCodes());
    }

    protected function handleWrongResponse(array $errors)
    {
        if (config('recaptcha_middleware.response_type') == self::HTML_RESPONSE_TYPE) {
            return abort(Response::HTTP_PRECONDITION_FAILED, 'Erros encontrados:<br /><pre>' . json_encode($errors) . '</pre>');
        }

        return response()
            ->json(
                [
                    'errors' => $errors,
                ],
                Response::HTTP_PRECONDITION_FAILED
            );
    }
}
