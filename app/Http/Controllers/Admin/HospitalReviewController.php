<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\HospitalReview;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Schema;

class HospitalReviewController extends Controller
{
    protected function hospitalReviewsReady(): bool
    {
        return Schema::hasTable('hospital_reviews') && Schema::hasColumn('hospital_reviews', 'status');
    }

    public function index(Request $request)
    {
        $status = $request->string('status')->toString() ?: 'all';

        if (! $this->hospitalReviewsReady()) {
            return view('admin.hospital_reviews.index', [
                'reviews' => new \Illuminate\Pagination\LengthAwarePaginator([], 0, 15),
                'counts' => ['all' => 0, 'pending' => 0, 'approved' => 0, 'rejected' => 0],
                'status' => $status,
                'schemaWarning' => 'Hospital reviews migrations are not fully applied yet.',
            ]);
        }

        $query = HospitalReview::query()
            ->with(['hospital:id,hospital_name,first_name,last_name', 'moderator:id,first_name,last_name'])
            ->latest();

        if (in_array($status, ['pending', 'approved', 'rejected'], true)) {
            $query->where('status', $status);
        }

        $reviews = $query->paginate(15)->withQueryString();

        $counts = [
            'all' => HospitalReview::count(),
            'pending' => HospitalReview::where('status', 'pending')->count(),
            'approved' => HospitalReview::where('status', 'approved')->count(),
            'rejected' => HospitalReview::where('status', 'rejected')->count(),
        ];

        return view('admin.hospital_reviews.index', compact('reviews', 'counts', 'status'));
    }

    public function update(Request $request, HospitalReview $hospitalReview)
    {
        abort_unless($this->hospitalReviewsReady(), 404);

        $data = $request->validate([
            'status' => ['required', 'in:approved,rejected'],
            'admin_note' => ['nullable', 'string', 'max:1000'],
        ]);

        $hospitalReview->update([
            'status' => $data['status'],
            'admin_note' => $data['admin_note'] ?? null,
            'moderated_by' => Auth::id(),
            'moderated_at' => now(),
        ]);

        return back()->with('success', 'Review status updated successfully.');
    }

    public function destroy(HospitalReview $hospitalReview)
    {
        abort_unless($this->hospitalReviewsReady(), 404);

        $hospitalReview->delete();

        return back()->with('success', 'Review deleted successfully.');
    }
}
