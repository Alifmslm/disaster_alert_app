<?php

namespace App\Http\Controllers\Api\User;

use App\Http\Controllers\Concerns\RespondsWithApi;
use App\Http\Controllers\Controller;
use App\Http\Requests\User\UpdateProfileRequest;
use App\Http\Resources\DisasterReportResource;
use App\Models\NotificationPreference;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class ProfileController extends Controller
{
    use RespondsWithApi;

    public function show(Request $request): JsonResponse
    {
        $user = $this->currentUser($request)->load('notificationPreference');

        return $this->success([
            'user' => $this->profilePayload($user),
        ], 'Profil pengguna berhasil diambil.');
    }

    public function update(UpdateProfileRequest $request): JsonResponse
    {
        $user = $this->currentUser($request);
        $user->fill($request->safe()->only(['name', 'phone', 'profile_photo_path']));
        $user->save();

        $preferencePayload = collect($request->validated())
            ->only(['alert_filter', 'sound_enabled', 'push_enabled', 'email_enabled'])
            ->filter(fn ($value) => $value !== null)
            ->all();

        if ($preferencePayload !== []) {
            NotificationPreference::query()->updateOrCreate(
                ['user_id' => $user->id],
                $preferencePayload
            );
        }

        return $this->success([
            'user' => $this->profilePayload($user->fresh('notificationPreference')),
        ], 'Profil pengguna berhasil diperbarui.');
    }

    public function reportHistory(Request $request): JsonResponse
    {
        $user = $this->currentUser($request);

        return $this->success(
            DisasterReportResource::collection($user->reports()->with(['attachments', 'disasterEvent'])->latest('id')->get()),
            'Riwayat laporan berhasil diambil.'
        );
    }

    public function notificationPreference(Request $request): JsonResponse
    {
        $preference = $this->currentUser($request)->notificationPreference()->firstOrCreate([]);

        return $this->success($preference, 'Preferensi notifikasi berhasil diambil.');
    }

    public function security(Request $request): JsonResponse
    {
        $user = $this->currentUser($request);

        return $this->success([
            'email' => $user->email,
            'password_change_available' => true,
            'two_factor_available' => false,
            'message' => 'Endpoint keamanan siap untuk integrasi auth lanjutan.',
        ], 'Informasi keamanan berhasil diambil.');
    }

    private function currentUser(Request $request): User
    {
        return $request->user() ?? User::query()->where('role', 'user')->firstOrFail();
    }

    private function profilePayload(User $user): array
    {
        return [
            'id' => $user->id,
            'name' => $user->name,
            'email' => $user->email,
            'phone' => $user->phone,
            'role' => $user->role,
            'profile_photo_path' => $user->profile_photo_path,
            'notification_preference' => $user->notificationPreference,
        ];
    }
}
