@extends('layouts.app')
@section('title', 'Agentic AI Idea')
@section('file', 'research / agentic-dast.idea')
@section('content')
<div class="idea-page {{ $darkMode ? 'bg-slate-950 text-slate-100' : 'bg-pink-50 text-slate-900' }}">
    <header class="page-heading">
        <p class="eyebrow">PBKK · WEEK 04 · AGENTIC AI</p>
        <h1>Security testing,<br>with an <em>AI agent.</em></h1>
        <p>A responsible concept for helping developers explore web application risks on explicitly authorised local targets.</p>
    </header>

    <div class="page-content stack">
        @if(session('status'))
            <x-status-banner type="success" data-testid="idea-success">
                <x-slot:title>Idea validated</x-slot:title>
                {{ session('status') }} Submitted topic: {{ session('submittedIdea') }}
            </x-status-banner>
        @endif

        @if($errors->any())
            <x-status-banner type="error" data-testid="idea-errors">
                <x-slot:title>Please check the form</x-slot:title>
                {{ $errors->count() }} field(s) still need attention.
            </x-status-banner>
        @endif

        <section class="agent-banner reveal">
            <div>
                <p class="eyebrow">THE CORE CONCEPT</p>
                <h2>Agentic AI for ethical DAST.</h2>
                <p>The agent maps pages and endpoints, studies application responses, chooses the next safe test, and turns validated findings into an understandable security report.</p>
                <span class="badge">LOCAL LAB TARGETS ONLY · OWASP JUICE SHOP / DVWA</span>
            </div>
            <div class="agent-file" aria-hidden="true"><span>agentic-dast.ai</span><strong>THINK → TEST → VERIFY</strong></div>
        </section>

        <section class="agent-flow-section">
            <p class="eyebrow">HOW THE AGENT WORKS</p>
            <h2>A traceable workflow, not a black box.</h2>
            <ol class="agent-flow">
                <li><span>01</span><h3>Discover</h3><p>Crawl approved pages, forms, and endpoints.</p></li>
                <li><span>02</span><h3>Reason</h3><p>Choose the next bounded test from observed evidence.</p></li>
                <li><span>03</span><h3>Validate</h3><p>Check responses for SQL injection and XSS indicators.</p></li>
                <li><span>04</span><h3>Report</h3><p>Explain findings, evidence, severity, and code-level fixes.</p></li>
            </ol>
        </section>

        <section class="content-grid project-story">
            <article class="panel"><p class="eyebrow">MVP SCOPE</p><h2>What we will build first</h2><ul class="plain-list"><li>Authorised target registration and scope controls.</li><li>Page crawling and HTML form analysis.</li><li>Safe SQL injection and reflected XSS test payloads.</li><li>Response validation with human-readable evidence.</li></ul></article>
            <article class="panel"><p class="eyebrow">SAFETY BOUNDARY</p><h2>Designed for responsible use</h2><ul class="plain-list"><li>No scanning without explicit permission.</li><li>Local lab targets are the default.</li><li>Rate limits and an emergency stop remain visible.</li><li>Every action is logged for review.</li></ul></article>
        </section>

        <section class="idea-form-section" aria-labelledby="idea-form-title">
            <div class="idea-form-copy"><p class="eyebrow">SHARE A RESEARCH ANGLE</p><h2 id="idea-form-title">Add your idea to the board.</h2><p>This Week 4 form demonstrates CSRF protection, server-side validation, old input, and a reusable status component. It intentionally does not persist to a database yet.</p></div>
            <form class="idea-form window" method="post" action="{{ route('idea.submit', ['mode' => $darkMode ? 'dark' : null]) }}" novalidate>
                @csrf
                <div class="window-bar"><span>submit-an-idea.form</span><span aria-hidden="true">− □ ×</span></div>
                <div class="idea-form-fields">
                    <div class="form-field"><label for="name">Name</label><input id="name" name="name" value="{{ old('name') }}" maxlength="80" required @error('name') aria-invalid="true" @enderror>@error('name')<p class="field-error">{{ $message }}</p>@enderror</div>
                    <div class="form-field"><label for="email">Email</label><input id="email" name="email" type="email" value="{{ old('email') }}" maxlength="120" required @error('email') aria-invalid="true" @enderror>@error('email')<p class="field-error">{{ $message }}</p>@enderror</div>
                    <div class="form-field"><label for="category">Category</label><select id="category" name="category" required @error('category') aria-invalid="true" @enderror><option value="">Choose one</option>@foreach($categories as $value => $label)<option value="{{ $value }}" @selected(old('category') === $value)>{{ $label }}</option>@endforeach</select>@error('category')<p class="field-error">{{ $message }}</p>@enderror</div>
                    <div class="form-field"><label for="title">Idea title</label><input id="title" name="title" value="{{ old('title') }}" minlength="5" maxlength="120" required @error('title') aria-invalid="true" @enderror>@error('title')<p class="field-error">{{ $message }}</p>@enderror</div>
                    <div class="form-field form-field-wide"><label for="description">Description</label><textarea id="description" name="description" rows="6" minlength="20" maxlength="1500" required @error('description') aria-invalid="true" @enderror>{{ old('description') }}</textarea>@error('description')<p class="field-error">{{ $message }}</p>@enderror</div>
                    <label class="ethical-check form-field-wide"><input type="checkbox" name="ethical_use" value="1" @checked(old('ethical_use'))> I will only apply security testing to systems I own or have permission to test.</label>
                    @error('ethical_use')<p class="field-error form-field-wide">{{ $message }}</p>@enderror
                    <div class="form-field-wide"><button class="button primary" type="submit">Validate idea ↗</button></div>
                </div>
            </form>
        </section>
    </div>
</div>
@endsection
