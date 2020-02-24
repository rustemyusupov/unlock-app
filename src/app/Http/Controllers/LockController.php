<?php

namespace App\Http\Controllers;

use App\Events\UnlockEvent;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Laravel\Passport\Passport;
use Spatie\Activitylog\Models\Activity;

/**
 * Class LockController
 * @package App\Http\Controllers
 */
class LockController extends Controller
{
    /**
     * Unlock specific door
     *
     * @param Request $request
     * @param string $scope
     *
     * @return JsonResponse
     */
    public function unlock(Request $request, string $scope): JsonResponse
    {
        if (!$request->user()->tokenCan($scope)) {
            throw new AuthorizationException();
        }

        /**
         * TODO Here should be logic for the real unlock functionality
         */
        event(new UnlockEvent(...Passport::scopesFor([$scope])));

        return response()->json(['success' => true]);
    }

    /**
     * Retrieve history
     *
     * @param Request $request
     *
     * @return LengthAwarePaginator
     */
    public function history(Request $request): LengthAwarePaginator
    {
        return Activity::where('causer_id', $request->user()->id)->paginate();
    }
}
