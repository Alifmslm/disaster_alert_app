<?php

namespace App\Http\Controllers\Api\Officer;

use App\Http\Controllers\Concerns\RespondsWithApi;
use App\Http\Controllers\Controller;
use App\Http\Requests\User\UpdateProfileRequest;
use App\Models\NotificationPreference;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class ProfileController extends Controller
{
    use RespondsWithApi;

    public function show(Request $request): JsonResponse
    {
        return $this->success([
            'officer' => $this->profilePayload($this->currentOfficer($request)->load('notificationPreference')),
        ], 'Profil petugas berhasil diambil.');
    }

    public function update(UpdateProfileRequest $request): JsonResponse
    {
        $officer = $this->currentOfficer($request);
        $officer->fill($request->safe()->only(['name', 'phone', 'profile_photo_path']));
        $officer->save();

        $preferencePayload = collect($request->validated())
            ->only(['alert_filter', 'sound_enabled', 'push_enabled', 'email_enabled'])
            ->filter(fn ($value) => $value !== null)
            ->all();

        if ($preferencePayload !== []) {
            NotificationPreference::query()->updateOrCreate(
                ['user_id' => $officer->id],
                $preferencePayload
            );
        }

        return $this->success([
            'officer' => $this->profilePayload($officer->fresh('notificationPreference')),
        ], 'Profil petugas berhasil diperbarui.');
    }

    public function security(Request $request): JsonResponse
    {
        $officer = $this->currentOfficer($request);

        return $this->success([
            'email' => $officer->email,
            'staff_id' => $officer->staff_id,
            'password_change_available' => true,
            'two_factor_available' => false,
        ], 'Informasi keamanan petugas berhasil diambil.');
    }

    public function notification(Request $request): JsonResponse
    {
        return $this->success(
            $this->currentOfficer($request)->notificationPreference()->firstOrCreate([]),
            'Notifikasi internal berhasil diambil.'
        );
    }

    public function support(): JsonResponse
    {
        return $this->success([
            'sop' => [
                'Verifikasi laporan masuk.',
                'Prioritaskan laporan dengan status emergency.',
                'Perbarui jalur evakuasi dan posko jika kondisi berubah.',
            ],
            'admin_contact' => 'admin@siaga-bencana.local',
        ], 'Bantuan petugas berhasil diambil.');
    }

    private function currentOfficer(Request $request): User
    {
        return $request->user() ?? User::query()->where('role', 'officer')->firstOrFail();
    }

    private function profilePayload(User $officer): array
    {
        return [
            'id' => $officer->id,
            'name' => $officer->name,
            'email' => $officer->email,
            'phone' => $officer->phone,
            'role' => $officer->role,
            'staff_id' => $officer->staff_id,
            'agency' => $officer->agency,
            'position' => $officer->position,
            'profile_photo_path' => $officer->profile_photo_path,
            'notification_preference' => $officer->notificationPreference,
        ];
    }
}
