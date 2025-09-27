<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\SocialPost;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class SocialPostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $socialPosts = SocialPost::ordered()->get();
        return view('admin.social-posts.index', compact('socialPosts'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $platforms = SocialPost::getSocialPlatforms();
        return view('admin.social-posts.create', compact('platforms'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'nullable|string|max:255',
            'description' => 'nullable|string|max:1000',
            'media_type' => 'required|in:image,video',
            'image' => 'required_if:media_type,image|nullable|image|mimes:jpeg,png,jpg,gif|max:5120',
            'video_file' => 'nullable|mimes:mp4,webm,mov,avi|max:51200', // 50MB max
            'video_url' => 'required_if:media_type,video|nullable|url',
            'overlay_text' => 'nullable|string|max:255',
            'overlay_position' => 'required|in:top,center,bottom',
            'social_platform' => 'required|in:facebook,instagram,tiktok,youtube,twitter',
            'social_url' => 'nullable|url|max:500',
            'button_text' => 'required|string|max:50',
            'button_color' => 'required|string|max:7',
            'order' => 'nullable|integer|min:0',
            'active' => 'required|boolean',
        ]);

        try {
            $data = $request->all();
            
            // Manejar carga de imagen
            if ($request->media_type === 'image' && $request->hasFile('image')) {
                $image = $request->file('image');
                $imageName = time() . '_' . Str::random(10) . '.' . $image->getClientOriginalExtension();
                $data['image'] = $image->storeAs('social-posts', $imageName, 'public');
            }

            if ($request->media_type === 'video' && $request->hasFile('video_file')) {
                $video = $request->file('video_file');
                $videoName = time() . '_' . Str::random(10) . '.' . $video->getClientOriginalExtension();
                $data['video_file'] = $video->storeAs('social-posts/videos', $videoName, 'public');
            }

            // Establecer color por defecto según la plataforma
            if (!$request->button_color) {
                $platforms = SocialPost::getSocialPlatforms();
                $data['button_color'] = $platforms[$request->social_platform]['color'] ?? '#1877F2';
            }

            $data['order'] = $request->order ?? 0;

            SocialPost::create($data);

            return redirect()
                ->route('admin.social-posts.index')
                ->with('success', 'Post social creado exitosamente.');

        } catch (\Exception $e) {
            return redirect()
                ->back()
                ->withInput()
                ->with('error', 'Error al crear el post: ' . $e->getMessage());
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(SocialPost $socialPost)
    {
        return view('admin.social-posts.show', compact('socialPost'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(SocialPost $socialPost)
    {
        $platforms = SocialPost::getSocialPlatforms();
        return view('admin.social-posts.edit', compact('socialPost', 'platforms'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, SocialPost $socialPost)
    {        
        // Validaciones básicas
        $rules = [
            'title' => 'nullable|string|max:255',
            'description' => 'nullable|string|max:1000',
            'media_type' => 'required|in:image,video',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:5120',
            'video_file' => 'nullable|mimes:mp4,webm,mov,avi|max:51200',
            'video_url' => 'nullable|url',
            'overlay_text' => 'nullable|string|max:255',
            'overlay_position' => 'required|in:top,center,bottom',
            'social_platform' => 'required|in:facebook,instagram,tiktok,youtube,twitter',
            'social_url' => 'nullable|url|max:500',
            'button_text' => 'required|string|max:50',
            'button_color' => 'required|string|max:7',
            'order' => 'nullable|integer|min:0',
            'active' => 'required|boolean',
        ];

        // Si es tipo video y no tiene archivo de video ni URL, requerir al menos uno
        if ($request->media_type === 'video') {
            $hasExistingVideo = $socialPost->video_file && !$request->hasFile('video_file');
            $hasNewVideo = $request->hasFile('video_file');
            $hasVideoUrl = !empty($request->video_url);
            
            if (!$hasExistingVideo && !$hasNewVideo && !$hasVideoUrl) {
                return redirect()
                    ->back()
                    ->withInput()
                    ->withErrors(['video_url' => 'Debes proporcionar una URL de video o subir un archivo de video.']);
            }
        }

        $request->validate($rules);

        try {
            $data = $request->all();
            $data['order'] = $request->order ?? 0;

            // Manejar carga de nueva imagen
            if ($request->media_type === 'image' && $request->hasFile('image')) {
                // Eliminar imagen anterior si existe
                if ($socialPost->image && Storage::disk('public')->exists($socialPost->image)) {
                    Storage::disk('public')->delete($socialPost->image);
                }

                // Subir nueva imagen
                $image = $request->file('image');
                $imageName = time() . '_' . Str::random(10) . '.' . $image->getClientOriginalExtension();
                $data['image'] = $image->storeAs('social-posts', $imageName, 'public');
            }
            
            // Manejar carga de nuevo video
            if ($request->media_type === 'video' && $request->hasFile('video_file')) {
                // Eliminar video anterior si existe
                if ($socialPost->video_file && Storage::disk('public')->exists($socialPost->video_file)) {
                    Storage::disk('public')->delete($socialPost->video_file);
                }

                // Subir nuevo video
                $video = $request->file('video_file');
                $videoName = time() . '_' . Str::random(10) . '.' . $video->getClientOriginalExtension();
                $data['video_file'] = $video->storeAs('social-posts/videos', $videoName, 'public');
            }

            // Si cambió de imagen a video, limpiar campo imagen
            if ($request->media_type === 'video') {
                if ($socialPost->image && Storage::disk('public')->exists($socialPost->image)) {
                    Storage::disk('public')->delete($socialPost->image);
                }
                $data['image'] = null;
            }

            // Si cambió de video a imagen, limpiar campo video
            if ($request->media_type === 'image') {
                $data['video_url'] = null;
            }

            $socialPost->update($data);

            return redirect()
                ->route('admin.social-posts.show', $socialPost)
                ->with('success', 'Post social actualizado exitosamente.');

        } catch (\Exception $e) {
            return redirect()
                ->back()
                ->withInput()
                ->with('error', 'Error al actualizar el post: ' . $e->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(SocialPost $socialPost)
    {
        try {
            // Eliminar imagen si existe
            if ($socialPost->image && Storage::disk('public')->exists($socialPost->image)) {
                Storage::disk('public')->delete($socialPost->image);
            }

            $socialPost->delete();

            return redirect()
                ->route('admin.social-posts.index')
                ->with('success', 'Post social eliminado exitosamente.');

        } catch (\Exception $e) {
            return redirect()
                ->back()
                ->with('error', 'Error al eliminar el post: ' . $e->getMessage());
        }
    }

    /**
     * Toggle the active status of a social post
     */
    public function toggleStatus(SocialPost $socialPost)
    {
        try {
            $socialPost->update([
                'active' => !$socialPost->active
            ]);

            $status = $socialPost->active ? 'activado' : 'desactivado';
            
            return response()->json([
                'success' => true,
                'message' => "Post {$status} exitosamente.",
                'active' => $socialPost->active
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error al cambiar el estado: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * Duplicate a social post
     */
    public function duplicate(SocialPost $socialPost)
    {
        try {
            $newPost = $socialPost->replicate();
            $newPost->title = $socialPost->title ? $socialPost->title . ' (Copia)' : null;
            $newPost->active = false;
            $newPost->order = SocialPost::max('order') + 1;
            
            // Copiar imagen si existe
            if ($socialPost->image && Storage::disk('public')->exists($socialPost->image)) {
                $extension = pathinfo($socialPost->image, PATHINFO_EXTENSION);
                $newImageName = time() . '_' . Str::random(10) . '.' . $extension;
                $newImagePath = 'social-posts/' . $newImageName;
                
                Storage::disk('public')->copy($socialPost->image, $newImagePath);
                $newPost->image = $newImagePath;
            }
            
            $newPost->save();

            return redirect()
                ->route('admin.social-posts.edit', $newPost)
                ->with('success', 'Post duplicado exitosamente. Puedes editarlo ahora.');

        } catch (\Exception $e) {
            return redirect()
                ->back()
                ->with('error', 'Error al duplicar el post: ' . $e->getMessage());
        }
    }
}