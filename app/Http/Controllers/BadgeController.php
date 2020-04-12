<?php

namespace App\Http\Controllers;

use App\Helpers\Helper;
use App\Helpers\Status;
use App\Http\Requests\StoreBadgeRequest;
use App\Http\Requests\UpdateBadgeRequest;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class BadgeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $badges = \App\Badge::where('state', Status::ACTIVE)
            ->orderByDesc('created_at')
            ->paginate();

        if ($badges->count()) {
            $badges->makeHidden(['updated_at']);
        }

        return response()->json($badges, JsonResponse::HTTP_OK);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        try {
            $badgeId = decrypt($id) ?? null;
            $message = 'Something went wrong please try again later!';

            if (!intval($badgeId)) {
                throw new \Exception($message);
            }

            $badge = \App\Badge::find($badgeId);

            if ($badge == null) {
                throw new \Exception($message);
            }

            return response()->json(
                $badge->setHidden(['updated_at']),
                JsonResponse::HTTP_OK
            );
        } catch (\Throwable $th) {
            return response()->json(
                ['message' => $th->getMessage()],
                JsonResponse::HTTP_UNPROCESSABLE_ENTITY
            );
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreBadgeRequest $request)
    {
        try {
            $badge = new \App\Badge();

            $badge->first_name = $request->firstName;
            $badge->last_name = $request->lastName;
            $badge->email = $request->email;
            $badge->job_title = $request->jobTitle;
            $badge->twitter = $request->twitter;
            $badge->avatar_url = Helper::getAvatar(
                $request->input('avatarUrl', null),
                $request->email
            );

            $badge->save();

            // The badge has been created correctly!
            return response()->json(
                $badge->setHidden(['updated_at']),
                JsonResponse::HTTP_OK
            );
        } catch (\Throwable $th) {
            return response()->json(
                ['message' => $th->getMessage()],
                JsonResponse::HTTP_UNPROCESSABLE_ENTITY
            );
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateBadgeRequest $request, $id)
    {
        try {
            $badgeId = decrypt($id) ?? null;
            $message = 'Something went wrong please try again later!';

            if (!intval($badgeId)) {
                throw new \Exception($message);
            }

            $badge = \App\Badge::find($badgeId);

            if ($badge == null) {
                throw new \Exception($message);
            }

            $badge->first_name = $request->firstName;
            $badge->last_name = $request->lastName;
            $badge->email = $request->email;
            $badge->job_title = $request->jobTitle;
            $badge->twitter = $request->twitter;
            if ($badge->isDirty('email')) {
                $badge->avatar_url = Helper::getAvatar(
                    $request->input('avatarUrl', null),
                    $request->email
                );
            }

            if ($badge->isDirty()) {
                $badge->update();
            }

            return response()->json(
                $badge->setHidden(['updated_at']),
                JsonResponse::HTTP_OK
            );
        } catch (\Throwable $th) {
            return response()->json(
                ['message' => $th->getMessage()],
                JsonResponse::HTTP_UNPROCESSABLE_ENTITY
            );
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
            $badgeId = decrypt($id) ?? null;
            $message = 'Something went wrong please try again later!';

            if (!intval($badgeId)) {
                throw new \Exception($message);
            }

            $badge = \App\Badge::find($badgeId);

            if ($badge == null) {
                throw new \Exception($message);
            }

            $badge->state = Status::DISABLED;
            $badge->update();

            return response()->json(
                ['message' => 'The badge has been removed successfully!'],
                JsonResponse::HTTP_OK
            );
        } catch (\Throwable $th) {
            return response()->json(
                ['message' => $th->getMessage()],
                JsonResponse::HTTP_UNPROCESSABLE_ENTITY
            );
        }
    }
}
