<?php

namespace Tests\Feature;

use App\Http\Controllers\PageController;
use Illuminate\Support\Facades\Route;
use Tests\TestCase;

class Pertemuan4Test extends TestCase
{
    public function test_required_pages_use_one_page_controller(): void
    {
        foreach (['home', 'profile', 'idea.agent'] as $name) {
            $route = Route::getRoutes()->getByName($name);

            $this->assertNotNull($route);
            $this->assertStringStartsWith(PageController::class.'@', $route->getActionName());
            $this->get(route($name))->assertOk();
        }
    }

    public function test_profile_renders_reusable_info_cards(): void
    {
        $this->get('/profil-mahasiswa')
            ->assertOk()
            ->assertSee('Angela Vania Sugiyono')
            ->assertSee('5025241226')
            ->assertSee('info-card', false)
            ->assertSee('Institut Teknologi Sepuluh Nopember');
    }

    public function test_welcome_query_is_dynamic_and_escaped(): void
    {
        $this->get('/beranda?user=Andi')
            ->assertOk()
            ->assertSee('Hello, Andi!')
            ->assertSee('status-banner', false);

        $this->get('/?user=%3Cscript%3Ealert(1)%3C%2Fscript%3E')
            ->assertOk()
            ->assertSee('&lt;script&gt;alert(1)&lt;/script&gt;', false)
            ->assertDontSee('<script>alert(1)</script>', false);
    }

    public function test_dark_mode_query_adds_a_controlled_dynamic_class(): void
    {
        $this->get('/ide-agent?mode=dark')
            ->assertOk()
            ->assertSee('data-route-theme="true"', false)
            ->assertSee('bg-slate-950 text-slate-100', false);

        $this->get('/ide-agent?mode=javascript:alert(1)')
            ->assertOk()
            ->assertDontSee('javascript:alert(1)', false)
            ->assertSee('bg-pink-50 text-slate-900', false);
    }

    public function test_idea_form_validates_and_uses_status_component(): void
    {
        $this->post('/ide-agent', [])->assertSessionHasErrors([
            'name', 'email', 'category', 'title', 'description', 'ethical_use',
        ]);

        $response = $this->post('/ide-agent', [
            'name' => 'Andi',
            'email' => 'andi@example.com',
            'category' => 'security',
            'title' => 'Explainable vulnerability triage',
            'description' => 'Add an evidence-based triage step before a finding reaches the final report.',
            'ethical_use' => '1',
        ]);

        $response->assertRedirect(route('idea.agent'));
        $this->followRedirects($response)
            ->assertOk()
            ->assertSee('Idea validated')
            ->assertSee('Thanks, Andi!')
            ->assertSee('status-banner-success', false);
    }

    public function test_master_layout_uses_vite_without_frontend_cdn(): void
    {
        $content = file_get_contents(resource_path('views/layouts/app.blade.php'));

        $this->assertStringContainsString('@vite(', $content);
        $this->assertStringNotContainsString('cdn.jsdelivr.net', $content);
        $this->assertStringNotContainsString('unpkg.com', $content);
        $this->assertStringNotContainsString("asset('css/", $content);
        $this->assertStringNotContainsString("asset('js/", $content);
    }
}
