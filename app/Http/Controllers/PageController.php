<?php

namespace App\Http\Controllers;

use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class PageController
{
    public function index(Request $request): View
    {
        return view('home', [
            'welcomeUser' => $this->welcomeUser($request),
        ]);
    }

    public function profile(): View
    {
        return view('about');
    }

    public function idea(Request $request): View
    {
        return view('idea-agent', [
            'darkMode' => $request->query('mode') === 'dark',
            'pageTheme' => $request->query('mode') === 'dark' ? 'terminal' : null,
            'categories' => $this->ideaCategories(),
        ]);
    }

    public function submitIdea(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:80'],
            'email' => ['required', 'email', 'max:120'],
            'category' => ['required', 'in:security,education,health,environment,other'],
            'title' => ['required', 'string', 'min:5', 'max:120'],
            'description' => ['required', 'string', 'min:20', 'max:1500'],
            'ethical_use' => ['accepted'],
        ]);

        return redirect()
            ->route('idea.agent', ['mode' => $request->query('mode') === 'dark' ? 'dark' : null])
            ->with('status', "Thanks, {$validated['name']}! Your idea passed validation.")
            ->with('submittedIdea', $validated['title']);
    }

    private function welcomeUser(Request $request): ?string
    {
        $user = $request->query('user');

        if (! is_string($user)) {
            return null;
        }

        $user = trim($user);

        return $user !== '' ? mb_substr($user, 0, 50) : null;
    }

    private function ideaCategories(): array
    {
        return [
            'security' => 'Web security',
            'education' => 'Education',
            'health' => 'Health technology',
            'environment' => 'Environment',
            'other' => 'Other',
        ];
    }
}
