<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">

    <meta
        name="viewport"
        content="width=device-width, initial-scale=1.0"
    >

    <meta
        name="csrf-token"
        content="{{ csrf_token() }}"
    >

    <title>AI Developer Tools</title>


    {{-- Bootstrap --}}
    <link
        href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
        rel="stylesheet"
    >


    {{-- Font Awesome --}}
    <link
        href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css"
        rel="stylesheet"
    >


    {{-- AI Tool CSS --}}
    <link
        rel="stylesheet"
        href="{{ asset('assets/ai/css/chat.css') }}"
    >

</head>


<body>


<div class="app-wrapper">


    {{-- =========================================================
         SIDEBAR
    ========================================================== --}}

    <aside
        class="sidebar"
        id="sidebar"
    >

        {{-- BRAND --}}

        <div class="brand">

            <div class="brand-icon">

                <i class="fa-solid fa-wand-magic-sparkles"></i>

            </div>

            <div class="brand-text">

                <h5>
                    AI Tools
                </h5>

                <small>
                    Developer Assistant
                </small>

            </div>

        </div>


        {{-- TOOL TITLE --}}

        <div class="sidebar-title">
            AI TOOLS
        </div>


        {{-- TOOL LIST --}}

        <div
            class="tool-list"
            id="toolList"
        >


            {{-- ASK AI --}}

            <button
                type="button"
                class="tool-item active"
                data-tool="ask_ai"
            >

                <span class="tool-icon">

                    <i class="fa-solid fa-star-of-life"></i>

                </span>

                <span class="tool-name">
                    Ask AI
                </span>

            </button>


            {{-- CODE GENERATOR --}}

            <button
                type="button"
                class="tool-item"
                data-tool="code_generator"
            >

                <span class="tool-icon">

                    <i class="fa-solid fa-code"></i>

                </span>

                <span class="tool-name">
                    Code Generator
                </span>

            </button>


            {{-- DEBUG --}}

            <button
                type="button"
                class="tool-item"
                data-tool="debug_code"
            >

                <span class="tool-icon">

                    <i class="fa-solid fa-bug"></i>

                </span>

                <span class="tool-name">
                    Debug Code
                </span>

            </button>


            {{-- EXPLAIN --}}

            <button
                type="button"
                class="tool-item"
                data-tool="explain_code"
            >

                <span class="tool-icon">

                    <i class="fa-solid fa-book-open"></i>

                </span>

                <span class="tool-name">
                    Explain Code
                </span>

            </button>


            {{-- SQL --}}

            <button
                type="button"
                class="tool-item"
                data-tool="sql_generator"
            >

                <span class="tool-icon">

                    <i class="fa-solid fa-database"></i>

                </span>

                <span class="tool-name">
                    SQL Generator
                </span>

            </button>


            {{-- API --}}

            <button
                type="button"
                class="tool-item"
                data-tool="api_builder"
            >

                <span class="tool-icon">

                    <i class="fa-solid fa-plug"></i>

                </span>

                <span class="tool-name">
                    API Builder
                </span>

            </button>


            {{-- DOCUMENTATION --}}

            <button
                type="button"
                class="tool-item"
                data-tool="documentation"
            >

                <span class="tool-icon">

                    <i class="fa-solid fa-file-lines"></i>

                </span>

                <span class="tool-name">
                    Documentation
                </span>

            </button>


        </div>


        {{-- STATUS --}}

        <div class="sidebar-bottom">

            <div class="status-box">

                <div class="status-row">

                    <span class="status-dot"></span>

                    <span class="status-name">
                        Gemini Connected
                    </span>

                </div>

                <div class="status-description">
                    AI provider is ready
                </div>

            </div>

        </div>

    </aside>


    {{-- =========================================================
         MAIN CONTENT
    ========================================================== --}}

    <main class="main-content">


        {{-- TOP BAR --}}

        <div class="topbar">


            <div class="topbar-left">


                {{-- MOBILE MENU --}}

                <button
                    type="button"
                    class="mobile-menu"
                    id="mobileMenu"
                >

                    <i class="fa-solid fa-bars"></i>

                </button>


                <div>

                    <h1 class="page-title">
                        AI Developer Workspace
                    </h1>

                    <div class="page-subtitle">
                        Build, debug, explain and generate code with AI
                    </div>

                </div>


            </div>


            {{-- PROVIDER --}}

            <div class="provider-badge">

                <i class="fa-solid fa-circle-check me-1"></i>

                Gemini Online

            </div>


        </div>


        {{-- =====================================================
             WORKSPACE
        ====================================================== --}}

        <div class="workspace">


            {{-- =================================================
                 LEFT INPUT PANEL
            ================================================== --}}

            <div class="panel">


                {{-- PANEL HEADER --}}

                <div class="panel-header">

                    <div>

                        <div class="panel-header-title">

                            <i class="fa-solid fa-pen-to-square me-2"></i>

                            Workspace

                        </div>

                        <div class="panel-header-subtitle">
                            Configure your AI request
                        </div>

                    </div>

                </div>


                {{-- PANEL BODY --}}

                <div class="panel-body">


                    {{-- SELECTED TOOL --}}

                    <div class="selected-tool">


                        <div
                            class="selected-tool-icon"
                            id="selectedToolIcon"
                        >

                           <i class="fa-solid fa-star-of-life"></i>

                        </div>


                        <div>

                            <h4
                                class="selected-tool-title"
                                id="selectedToolTitle"
                            >
                                Ask AI
                            </h4>

                            <p
                                class="selected-tool-description"
                                id="selectedToolDescription"
                            >
                                Ask anything about Laravel, PHP,
                                MySQL, JavaScript or development.
                            </p>

                        </div>


                    </div>


                    {{-- =================================================
                         TOOL FORMS
                    ================================================== --}}

                    <div id="toolForms">


                        {{-- =================================================
                             ASK AI
                        ================================================== --}}

                        <div
                            class="tool-form"
                            data-form="ask_ai"
                        >

                            <label class="form-label">
                                What do you want to ask?
                            </label>

                            <textarea
                                class="form-control"
                                id="askPrompt"
                                placeholder="Example: Explain Laravel service container with a practical example..."
                            ></textarea>

                        </div>


                        {{-- =================================================
                             CODE GENERATOR
                        ================================================== --}}

                        <div
                            class="tool-form d-none"
                            data-form="code_generator"
                        >


                            <div class="row g-3">


                                <div class="col-md-6">

                                    <label class="form-label">
                                        Language
                                    </label>

                                    <select
                                        class="form-select"
                                        id="codeLanguage"
                                    >

                                        <option value="PHP">
                                            PHP
                                        </option>

                                        <option value="JavaScript">
                                            JavaScript
                                        </option>

                                        <option value="TypeScript">
                                            TypeScript
                                        </option>

                                        <option value="SQL">
                                            SQL
                                        </option>

                                        <option value="HTML">
                                            HTML
                                        </option>

                                        <option value="CSS">
                                            CSS
                                        </option>

                                    </select>

                                </div>


                                <div class="col-md-6">

                                    <label class="form-label">
                                        Framework
                                    </label>

                                    <select
                                        class="form-select"
                                        id="codeFramework"
                                    >

                                        <option value="Laravel">
                                            Laravel
                                        </option>

                                        <option value="CodeIgniter">
                                            CodeIgniter
                                        </option>

                                        <option value="Node.js">
                                            Node.js
                                        </option>

                                        <option value="React.js">
                                            React.js
                                        </option>

                                        <option value="Vue.js">
                                            Vue.js
                                        </option>

                                        <option value="None">
                                            None
                                        </option>

                                    </select>

                                </div>


                            </div>


                            <div class="mt-3">

                                <label class="form-label">
                                    Describe what you want to build
                                </label>

                                <textarea
                                    class="form-control"
                                    id="codePrompt"
                                    placeholder="Example: Create a Laravel login API with email/password validation and Sanctum authentication..."
                                ></textarea>

                            </div>


                            {{-- OPTIONS --}}

                            <div class="options-box">

                                <div class="options-title">
                                    Include
                                </div>


                                <div class="row">


                                    <div class="col-md-6">

                                        <div class="form-check">

                                            <input
                                                class="form-check-input"
                                                type="checkbox"
                                                id="includeController"
                                                checked
                                            >

                                            <label
                                                class="form-check-label"
                                                for="includeController"
                                            >
                                                Controller
                                            </label>

                                        </div>


                                        <div class="form-check">

                                            <input
                                                class="form-check-input"
                                                type="checkbox"
                                                id="includeValidation"
                                                checked
                                            >

                                            <label
                                                class="form-check-label"
                                                for="includeValidation"
                                            >
                                                Request Validation
                                            </label>

                                        </div>

                                    </div>


                                    <div class="col-md-6">

                                        <div class="form-check">

                                            <input
                                                class="form-check-input"
                                                type="checkbox"
                                                id="includeRoute"
                                                checked
                                            >

                                            <label
                                                class="form-check-label"
                                                for="includeRoute"
                                            >
                                                API Route
                                            </label>

                                        </div>


                                        <div class="form-check">

                                            <input
                                                class="form-check-input"
                                                type="checkbox"
                                                id="includeModel"
                                            >

                                            <label
                                                class="form-check-label"
                                                for="includeModel"
                                            >
                                                Model / Migration
                                            </label>

                                        </div>

                                    </div>


                                </div>

                            </div>


                        </div>


                        {{-- =================================================
                             DEBUG CODE
                        ================================================== --}}

                        <div
                            class="tool-form d-none"
                            data-form="debug_code"
                        >


                            <div class="mb-3">

                                <label class="form-label">
                                    Language
                                </label>

                                <select
                                    class="form-select"
                                    id="debugLanguage"
                                >

                                    <option value="PHP">
                                        PHP
                                    </option>

                                    <option value="JavaScript">
                                        JavaScript
                                    </option>

                                    <option value="SQL">
                                        SQL
                                    </option>

                                    <option value="HTML">
                                        HTML
                                    </option>

                                    <option value="CSS">
                                        CSS
                                    </option>

                                </select>

                            </div>


                            <label class="form-label">
                                Paste your code
                            </label>

                            <textarea
                                class="form-control code-input"
                                id="debugCode"
                                placeholder="Paste the code containing the error..."
                            ></textarea>


                        </div>


                        {{-- =================================================
                             EXPLAIN CODE
                        ================================================== --}}

                        <div
                            class="tool-form d-none"
                            data-form="explain_code"
                        >


                            <div class="mb-3">

                                <label class="form-label">
                                    Language
                                </label>

                                <select
                                    class="form-select"
                                    id="explainLanguage"
                                >

                                    <option value="PHP">
                                        PHP
                                    </option>

                                    <option value="JavaScript">
                                        JavaScript
                                    </option>

                                    <option value="SQL">
                                        SQL
                                    </option>

                                    <option value="HTML">
                                        HTML
                                    </option>

                                    <option value="CSS">
                                        CSS
                                    </option>

                                </select>

                            </div>


                            <label class="form-label">
                                Code to explain
                            </label>

                            <textarea
                                class="form-control code-input"
                                id="explainCode"
                                placeholder="Paste your code here..."
                            ></textarea>


                        </div>


                        {{-- =================================================
                             SQL GENERATOR
                        ================================================== --}}

                        <div
                            class="tool-form d-none"
                            data-form="sql_generator"
                        >


                            <div class="mb-3">

                                <label class="form-label">
                                    Database
                                </label>

                                <select
                                    class="form-select"
                                    id="databaseType"
                                >

                                    <option value="MySQL">
                                        MySQL
                                    </option>

                                    <option value="PostgreSQL">
                                        PostgreSQL
                                    </option>

                                    <option value="SQLite">
                                        SQLite
                                    </option>

                                    <option value="SQL Server">
                                        SQL Server
                                    </option>

                                </select>

                            </div>


                            <label class="form-label">
                                Describe the query
                            </label>

                            <textarea
                                class="form-control"
                                id="sqlPrompt"
                                placeholder="Example: Get all customers who placed more than 5 orders in the last 30 days..."
                            ></textarea>


                        </div>


                        {{-- =================================================
                             API BUILDER
                        ================================================== --}}

                        <div
                            class="tool-form d-none"
                            data-form="api_builder"
                        >


                            <div class="row g-3 mb-3">


                                <div class="col-md-4">

                                    <label class="form-label">
                                        Method
                                    </label>

                                    <select
                                        class="form-select"
                                        id="apiMethod"
                                    >

                                        <option value="GET">
                                            GET
                                        </option>

                                        <option value="POST">
                                            POST
                                        </option>

                                        <option value="PUT">
                                            PUT
                                        </option>

                                        <option value="PATCH">
                                            PATCH
                                        </option>

                                        <option value="DELETE">
                                            DELETE
                                        </option>

                                    </select>

                                </div>


                                <div class="col-md-8">

                                    <label class="form-label">
                                        Endpoint
                                    </label>

                                    <input
                                        type="text"
                                        class="form-control"
                                        id="apiEndpoint"
                                        placeholder="/api/customers"
                                    >

                                </div>


                            </div>


                            <label class="form-label">
                                API Description
                            </label>

                            <textarea
                                class="form-control"
                                id="apiDescription"
                                placeholder="Describe request parameters, validation, authentication and expected response..."
                            ></textarea>


                        </div>


                        {{-- =================================================
                             DOCUMENTATION
                        ================================================== --}}

                        <div
                            class="tool-form d-none"
                            data-form="documentation"
                        >


                            <div class="mb-3">

                                <label class="form-label">
                                    Documentation Format
                                </label>

                                <select
                                    class="form-select"
                                    id="documentationFormat"
                                >

                                    <option value="Markdown">
                                        Markdown
                                    </option>

                                    <option value="HTML">
                                        HTML
                                    </option>

                                    <option value="Plain Text">
                                        Plain Text
                                    </option>

                                    <option value="Laravel PHPDoc">
                                        Laravel PHPDoc
                                    </option>

                                </select>

                            </div>


                            <label class="form-label">
                                Code / Feature Description
                            </label>

                            <textarea
                                class="form-control code-input"
                                id="documentationInput"
                                placeholder="Paste code or describe the feature that needs documentation..."
                            ></textarea>


                        </div>


                    </div>


                    {{-- =================================================
                         ACTIONS
                    ================================================== --}}

                    <div class="action-buttons">


                        <button
                            type="button"
                            class="btn-generate"
                            id="generateButton"
                        >

                            <i class="fa-solid fa-wand-magic-sparkles me-2"></i>

                            Generate

                        </button>


                        <button
                            type="button"
                            class="btn-clear"
                            id="clearButton"
                        >

                            <i class="fa-solid fa-rotate-left me-1"></i>

                            Clear

                        </button>


                    </div>


                    {{-- QUICK EXAMPLES --}}

                    <div class="quick-actions">

                        <div class="quick-title">
                            Quick examples
                        </div>


                        <div class="quick-list">


                            <button
                                type="button"
                                class="quick-chip"
                                data-example="Create Laravel CRUD API"
                            >
                                Laravel CRUD API
                            </button>


                            <button
                                type="button"
                                class="quick-chip"
                                data-example="Create Laravel Sanctum authentication"
                            >
                                Sanctum Auth
                            </button>


                            <button
                                type="button"
                                class="quick-chip"
                                data-example="Optimize this MySQL query"
                            >
                                Optimize SQL
                            </button>


                            <button
                                type="button"
                                class="quick-chip"
                                data-example="Explain Laravel service container"
                            >
                                Explain Laravel
                            </button>


                        </div>

                    </div>


                </div>

            </div>


            {{-- =================================================
                 RIGHT RESULT PANEL
            ================================================== --}}

            <div class="panel">


                {{-- RESULT HEADER --}}

                <div class="panel-header">


                    <div>

                        <div class="panel-header-title">

                            <i class="fa-solid fa-terminal me-2"></i>

                            AI Result

                        </div>

                        <div class="panel-header-subtitle">
                            Generated by Gemini
                        </div>

                    </div>


                    {{-- RESULT ACTIONS --}}

                    <div class="result-toolbar">


                        <button
                            type="button"
                            class="result-btn"
                            id="copyAllButton"
                        >

                            <i class="fa-regular fa-copy me-1"></i>

                            Copy All

                        </button>


                        <button
                            type="button"
                            class="result-btn"
                            id="regenerateButton"
                        >

                            <i class="fa-solid fa-rotate me-1"></i>

                            Regenerate

                        </button>


                    </div>


                </div>


                {{-- RESULT BODY --}}

                <div class="panel-body result-area">


                    {{-- EMPTY STATE --}}

                    <div
                        class="empty-result"
                        id="emptyResult"
                    >


                        <div class="empty-result-icon">

                           <i class="fa-solid fa-star-of-life"></i>

                        </div>


                        <h6>
                            Your AI result will appear here
                        </h6>


                        <p>
                            Select a tool, describe what you need
                            and click Generate to let Gemini
                            create your result.
                        </p>


                    </div>


                    {{-- LOADING --}}

                    <div
                        class="loading-state"
                        id="loadingState"
                    >

                        <div class="loader"></div>

                        <span>
                            Gemini is generating your result...
                        </span>

                    </div>


                    {{-- RESULT --}}

                    <div
                        class="result-content"
                        id="resultContent"
                    >

                        <div
                            class="result-scroll"
                            id="resultScroll"
                        ></div>

                    </div>


                </div>

            </div>


        </div>


    </main>


</div>


<script>
    window.aiChatSendUrl = @json(route('ai.chat.send'));
</script>
<script
    src="{{ asset('assets/ai/js/chat.js') }}"
></script>


</body>

</html>
