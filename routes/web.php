<?php
use Illuminate\Support\Facades\Route;

use Illuminate\Support\Facades\Auth;
// Direktur
use App\Http\Controllers\Direktur\DashboardController;
use App\Http\Controllers\Direktur\ArtworkController;
use App\Http\Controllers\Direktur\ReportController;
// Admin
use App\Http\Controllers\Admin\DashboardController as AdminDashboardController;
use App\Http\Controllers\Admin\ArtworkController as AdminArtworkController;
use App\Http\Controllers\Admin\MemberController;
use App\Http\Controllers\Admin\ReportController as AdminReportController;
use App\Http\Controllers\Admin\AdminChatController;
// Tim
use App\Http\Controllers\Tim\ArtworkController as TimArtworkController;
use App\Http\Controllers\Tim\TimDashboardController;
use App\Http\Controllers\Tim\ProjectdoneController;
// Member
use App\Http\Controllers\Member\DashboardController as MemberDashboardController;
use App\Http\Controllers\Member\HistoryController;
use App\Http\Controllers\UserChatController;
use App\Http\Controllers\Member\ArtworkProgressController;
// Landing
use App\Http\Controllers\LandingController;
// Breeze
use App\Http\Controllers\ProfileController;
// Chat Artwork
use App\Http\Controllers\Chat\ArtworkChatController;

Route::get('/', [LandingController::class, 'index'])->name('landing.index');
Route::get('/about', [LandingController::class, 'about'])->name('landing.about');
Route::get('/features', [LandingController::class, 'features'])->name('landing.features');
Route::get('/dashboard', function () {

    $user = Auth::user();

    if ($user->role === 'direktur') {
        return redirect()->route('direktur.dashboard');
    }

    if ($user->role === 'admin') {
        return redirect()->route('admin.dashboard');
    }

    if ($user->role === 'member') {
        return redirect()->route('member.dashboard');
    }

    if ($user->role === 'tim') {
        return redirect()->route('tim.dashboard');
    }

    abort(403);

})->middleware(['auth'])->name('dashboard');
Route::get('/karya/flashandblood', function () {return view('karya.flashandblood');});
Route::get('/karya/smite', function () {return view('karya.smite');});
Route::get('/karya/capcom', function () {return view('karya.capcom');});
Route::get('/karya/fablecraft', function () {return view('karya.fablecraft');});

Route::prefix('direktur')
    ->middleware(['auth', 'role:direktur'])
    ->name('direktur.')
    ->group(function () {

        Route::get('/dashboard', [DashboardController::class, 'index'])
            ->name('dashboard');

        Route::resource('artworks', ArtworkController::class);

        Route::patch('artworks/{artwork}/archive', 
            [ArtworkController::class, 'archive']
        )->name('artworks.archive');

        Route::get('artworks/{artwork}/invoice',
            [ArtworkController::class, 'invoice']
        )->name('artworks.invoice');

        Route::patch('artworks/{artwork}/return',
            [ArtworkController::class, 'markAsFinished']
        )->name('artworks.return');

        Route::get('artworks/{artwork}/assign-tim',
            [ArtworkController::class, 'assignTimForm']
        )->name('artworks.assignTimForm');

        Route::post('artworks/{artwork}/assign-tim',
            [ArtworkController::class, 'assignTim']
        )->name('artworks.assignTim');

        Route::get('reports', [ReportController::class, 'index'])
        ->name('reports.index');

        Route::get('/reports/{artwork}', [ReportController::class, 'show'])
            ->name('reports.show');
            
    });

Route::prefix('admin')
    ->middleware(['auth', 'role:admin'])
    ->name('admin.')
    ->group(function () {

        Route::get('/dashboard', [AdminDashboardController::class, 'index'])
            ->name('dashboard');

        /* =======================
         | ARTWORK (PROJECT)
         ======================= */
        Route::resource('artworks', AdminArtworkController::class);

        Route::patch('artworks/{artwork}/archive',
            [AdminArtworkController::class, 'archive']
        )->name('artworks.archive');

        Route::get('artworks/{artwork}/invoice',
            [AdminArtworkController::class, 'invoice']
        )->name('artworks.invoice');

        Route::patch('artworks/{artwork}/return',
            [AdminArtworkController::class, 'markAsFinished']
        )->name('artworks.return');

        Route::post('artworks/{artwork}/archive',
            [ArtworkController::class, 'archive']
        )->name('admin.artworks.archive');

        Route::get('reports', [AdminReportController::class, 'index'])
            ->name('reports.index');

        Route::post('reports/request-revision',
            [AdminReportController::class, 'requestRevision'])
            ->name('reports.requestRevision');

        Route::resource('members', MemberController::class);

        Route::patch('members/{id}/toggle-status',
            [MemberController::class, 'toggleStatus']
        )->name('members.toggle-status');
    });

Route::prefix('member')
    ->middleware(['auth', 'role:member'])
    ->name('member.')
    ->group(function () {

        Route::get('/dashboard', [MemberDashboardController::class, 'index'])
            ->name('dashboard');

        Route::resource('artworks', \App\Http\Controllers\Member\ArtworkController::class)
            ->only(['index', 'show']);

        Route::get('history', [HistoryController::class, 'index'])
            ->name('history.index');

        Route::patch('progress/{progress}/approve',
            [ArtworkProgressController::class, 'approve'])
            ->name('progress.approve');

        Route::patch('progress/{progress}/revisi',
            [ArtworkProgressController::class, 'revisi'])
            ->name('progress.revisi');

        Route::patch('/member/progress/{progress}/revisi',
            [ArtworkProgressController::class, 'revisi']
            )->name('member.progress.revisi');

        Route::get('/history', [HistoryController::class, 'index'])
            ->name('history.index');

        Route::get('/history/{artwork}', [HistoryController::class, 'show'])
            ->name('history.show');

    });

Route::prefix('tim')
    ->middleware(['auth', 'role:tim'])
    ->name('tim.')
    ->group(function () {
        Route::get('/dashboard', [TimDashboardController::class, 'index'])
        ->name('dashboard');

        Route::get('artworks',
            [TimArtworkController::class, 'index']
        )->name('artworks.index');

        Route::get('project', [ProjectdoneController::class, 'index'])
            ->name('project.index');
        
        Route::get('/project/{artwork}', [ProjectdoneController::class, 'show'])
        ->name('project.show');

        Route::get('artworks/{artwork}',
            [TimArtworkController::class, 'show']
        )->name('artworks.show');

        Route::patch('artworks/{artwork}/progress',
            [TimArtworkController::class, 'upload']
        )->name('artworks.progress');

        Route::delete('progress/{progress}', 
            [TimArtworkController::class, 'destroy']
        )->name('progress.destroy');

    });

Route::middleware(['auth', 'role:member'])
    ->prefix('member')
    ->name('member.')
    ->group(function () {

        Route::get('/chat', [UserChatController::class, 'index'])
            ->name('chat');

        Route::post('/chat/send', [UserChatController::class, 'send'])
            ->name('chat.send');
            
    });

Route::middleware(['auth','role:member,tim'])
    ->group(function () {

        Route::get('/artworks/{artwork}/chat',
            [ArtworkChatController::class, 'index']
        )->name('artworks.chat');

        Route::post('/artworks/{artwork}/chat',
            [ArtworkChatController::class, 'store']
        )->name('artworks.chat.store');
    });

Route::prefix('admin')
    ->middleware(['auth', 'role:admin'])
    ->name('admin.chat.')
    ->group(function () {

        Route::get('chat', [AdminChatController::class, 'index'])
            ->name('index');

        Route::get('chat/{user}', [AdminChatController::class, 'show'])
            ->name('show');

        Route::post('chat/{user}', [AdminChatController::class, 'send'])
            ->name('send');

        Route::get('chat/{user}/load', [AdminChatController::class, 'load'])
            ->name('load');

        Route::delete('chat/message/{id}', function ($id) {
            \App\Models\Message::where('id', $id)->delete();
            return response()->noContent();
        })->name('message.delete');
    });

Route::middleware('auth')->group(function () {

    Route::get('/profile', [ProfileController::class, 'edit'])
        ->name('profile.edit');

    Route::put('/profile/update', [ProfileController::class, 'update'])
        ->name('profile.update');

    Route::put('/profile/update-password',
        [ProfileController::class, 'updatePassword'])
        ->name('profile.password.update');
});

require __DIR__ . '/auth.php';
