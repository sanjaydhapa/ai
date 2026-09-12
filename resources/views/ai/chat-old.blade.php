<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>AI Developer Tools</title>

    <link
        href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
        rel="stylesheet"
    >

    <link
        href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css"
        rel="stylesheet"
    >

    <style>
        * {
            box-sizing: border-box;
        }

        body {
            margin: 0;
            background: #0b1020;
            color: #e5e7eb;
            font-family: Inter, system-ui, -apple-system, BlinkMacSystemFont,
                "Segoe UI", sans-serif;
            min-height: 100vh;
        }

        .app-wrapper {
            display: flex;
            min-height: 100vh;
        }

        /* =========================
           SIDEBAR
        ========================= */

        .sidebar {
            width: 270px;
            min-width: 270px;
            background: #111827;
            border-right: 1px solid #263044;
            padding: 22px 15px;
            display: flex;
            flex-direction: column;
        }

        .brand {
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 5px 10px 25px;
        }

        .brand-icon {
            width: 42px;
            height: 42px;
            border-radius: 12px;
            background: linear-gradient(135deg, #6366f1, #8b5cf6);
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 19px;
            color: #fff;
            box-shadow: 0 8px 25px rgba(99, 102, 241, .25);
        }

        .brand-text h5 {
            margin: 0;
            color: #fff;
            font-weight: 700;
        }

        .brand-text small {
            color: #8892a7;
        }

        .sidebar-title {
            font-size: 11px;
            letter-spacing: 1.5px;
            font-weight: 700;
            color: #69758b;
            padding: 0 12px 10px;
        }

        .tool-item {
            width: 100%;
            border: 0;
            background: transparent;
            color: #aeb8ca;
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 11px 12px;
            border-radius: 10px;
            margin-bottom: 4px;
            text-align: left;
            transition: .2s;
            cursor: pointer;
        }

        .tool-item:hover {
            background: #1b2538;
            color: #fff;
        }

        .tool-item.active {
            background: linear-gradient(
                90deg,
                rgba(99, 102, 241, .20),
                rgba(139, 92, 246, .08)
            );
            color: #fff;
            border: 1px solid rgba(99, 102, 241, .25);
        }

        .tool-icon {
            width: 34px;
            height: 34px;
            border-radius: 9px;
            display: flex;
            align-items: center;
            justify-content: center;
            background: #1d2638;
            color: #8b9cff;
        }

        .tool-item.active .tool-icon {
            background: #6366f1;
            color: #fff;
        }

        .tool-name {
            font-size: 14px;
            font-weight: 500;
        }

        .sidebar-bottom {
            margin-top: auto;
            border-top: 1px solid #263044;
            padding-top: 15px;
        }

        .status-box {
            padding: 12px;
            border-radius: 10px;
            background: #0c1424;
            border: 1px solid #263044;
        }

        .status-dot {
            width: 8px;
            height: 8px;
            border-radius: 50%;
            background: #22c55e;
            display: inline-block;
            margin-right: 7px;
        }

        .status-text {
            font-size: 12px;
            color: #8f9bb0;
        }

        /* =========================
           MAIN AREA
        ========================= */

        .main-content {
            flex: 1;
            min-width: 0;
            padding: 25px;
            background:
                radial-gradient(
                    circle at 80% 0%,
                    rgba(99, 102, 241, .08),
                    transparent 30%
                ),
                #0b1020;
        }

        .topbar {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-bottom: 25px;
        }

        .page-title {
            margin: 0;
            font-size: 24px;
            font-weight: 700;
            color: #fff;
        }

        .page-subtitle {
            color: #7e8aa1;
            font-size: 13px;
            margin-top: 4px;
        }

        .provider-badge {
            padding: 8px 13px;
            border-radius: 20px;
            background: rgba(34, 197, 94, .08);
            border: 1px solid rgba(34, 197, 94, .20);
            color: #4ade80;
            font-size: 12px;
        }

        .workspace {
            display: grid;
            grid-template-columns: minmax(0, 1fr) minmax(0, 1fr);
            gap: 20px;
        }

        .panel {
            background: #111827;
            border: 1px solid #263044;
            border-radius: 15px;
            overflow: hidden;
            box-shadow: 0 15px 40px rgba(0, 0, 0, .12);
        }

        .panel-header {
            padding: 17px 20px;
            border-bottom: 1px solid #263044;
            display: flex;
            align-items: center;
            justify-content: space-between;
        }

        .panel-header h6 {
            margin: 0;
            color: #fff;
            font-weight: 600;
        }

        .panel-header small {
            color: #69758b;
        }

        .panel-body {
            padding: 20px;
        }

        /* =========================
           TOOL HEADER
        ========================= */

        .selected-tool {
            display: flex;
            gap: 14px;
            align-items: center;
            margin-bottom: 22px;
        }

        .selected-tool-icon {
            width: 50px;
            height: 50px;
            border-radius: 13px;
            background: linear-gradient(135deg, #6366f1, #8b5cf6);
            display: flex;
            align-items: center;
            justify-content: center;
            color: #fff;
            font-size: 20px;
        }

        .selected-tool h4 {
            margin: 0;
            font-size: 19px;
            color: #fff;
        }

        .selected-tool p {
            margin: 4px 0 0;
            color: #77839a;
            font-size: 12px;
        }

        /* =========================
           FORM
        ========================= */

        .form-label {
            color: #aeb8ca;
            font-size: 13px;
            font-weight: 500;
            margin-bottom: 7px;
        }

        .form-control,
        .form-select {
            background: #0c1424;
            border: 1px solid #2a354b;
            color: #e5e7eb;
            border-radius: 9px;
            padding: 11px 13px;
            font-size: 13px;
        }

        .form-control:focus,
        .form-select:focus {
            background: #0c1424;
            color: #fff;
            border-color: #6366f1;
            box-shadow: 0 0 0 3px rgba(99, 102, 241, .12);
        }

        .form-control::placeholder {
            color: #556177;
        }

        textarea.form-control {
            resize: vertical;
            min-height: 190px;
            line-height: 1.6;
        }

        .code-input {
            font-family: "JetBrains Mono", Consolas, monospace;
            font-size: 12px !important;
        }

        /* =========================
           OPTIONS
        ========================= */

        .options-box {
            margin-top: 18px;
            padding: 15px;
            background: #0c1424;
            border: 1px solid #263044;
            border-radius: 10px;
        }

        .options-title {
            font-size: 11px;
            text-transform: uppercase;
            letter-spacing: 1px;
            color: #69758b;
            margin-bottom: 12px;
            font-weight: 700;
        }

        .form-check {
            margin-bottom: 7px;
        }

        .form-check-label {
            color: #9ba7ba;
            font-size: 12px;
        }

        .form-check-input {
            background-color: #0b1020;
            border-color: #39455c;
        }

        .form-check-input:checked {
            background-color: #6366f1;
            border-color: #6366f1;
        }

        /* =========================
           BUTTONS
        ========================= */

        .action-buttons {
            display: flex;
            gap: 10px;
            margin-top: 20px;
        }

        .btn-generate {
            flex: 1;
            border: 0;
            padding: 12px 18px;
            border-radius: 9px;
            background: linear-gradient(135deg, #6366f1, #8b5cf6);
            color: #fff;
            font-size: 13px;
            font-weight: 600;
            transition: .2s;
        }

        .btn-generate:hover {
            transform: translateY(-1px);
            box-shadow: 0 8px 25px rgba(99, 102, 241, .25);
            color: #fff;
        }

        .btn-generate:disabled {
            opacity: .6;
            transform: none;
        }

        .btn-clear {
            border: 1px solid #303b50;
            background: transparent;
            color: #9ba7ba;
            padding: 12px 18px;
            border-radius: 9px;
            font-size: 13px;
        }

        .btn-clear:hover {
            background: #1a2335;
            color: #fff;
        }

        /* =========================
           RESULT
        ========================= */

        .result-toolbar {
            display: flex;
            gap: 7px;
        }

        .result-btn {
            border: 1px solid #303b50;
            background: #0c1424;
            color: #8995a9;
            border-radius: 7px;
            padding: 6px 9px;
            font-size: 11px;
        }

        .result-btn:hover {
            color: #fff;
            border-color: #4b5870;
        }

        .result-area {
            min-height: 500px;
            position: relative;
        }

        .empty-result {
            height: 500px;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            text-align: center;
            color: #59667d;
        }

        .empty-result-icon {
            width: 65px;
            height: 65px;
            border-radius: 18px;
            background: #0c1424;
            border: 1px solid #263044;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 25px;
            margin-bottom: 15px;
            color: #59667d;
        }

        .empty-result h6 {
            color: #8b96aa;
            margin-bottom: 5px;
        }

        .empty-result p {
            max-width: 320px;
            font-size: 12px;
            line-height: 1.6;
        }

        .result-content {
            display: none;
        }

        .result-content pre {
            margin: 0;
            background: #080d18;
            border: 1px solid #202b3e;
            border-radius: 10px;
            padding: 18px;
            max-height: 550px;
            overflow: auto;
            color: #dbe3f0;
            font-family: "JetBrains Mono", Consolas, monospace;
            font-size: 12px;
            line-height: 1.7;
            white-space: pre-wrap;
            word-break: break-word;
        }

        /* =========================
           LOADING
        ========================= */

        .loading-state {
            display: none;
            height: 500px;
            align-items: center;
            justify-content: center;
            flex-direction: column;
        }

        .loader {
            width: 42px;
            height: 42px;
            border: 3px solid #2a354b;
            border-top-color: #6366f1;
            border-radius: 50%;
            animation: spin 1s linear infinite;
            margin-bottom: 15px;
        }

        .loading-state span {
            color: #77839a;
            font-size: 12px;
        }

        @keyframes spin {
            to {
                transform: rotate(360deg);
            }
        }

        /* =========================
           QUICK ACTIONS
        ========================= */

        .quick-actions {
            margin-top: 20px;
        }

        .quick-title {
            color: #7d899e;
            font-size: 12px;
            margin-bottom: 10px;
        }

        .quick-list {
            display: flex;
            flex-wrap: wrap;
            gap: 8px;
        }

        .quick-chip {
            border: 1px solid #29354a;
            background: #111827;
            color: #8d99ad;
            border-radius: 20px;
            padding: 7px 11px;
            font-size: 11px;
            cursor: pointer;
        }

        .quick-chip:hover {
            color: #fff;
            border-color: #4b5870;
        }

        /* =========================
           MOBILE
        ========================= */

        .mobile-menu {
            display: none;
            border: 1px solid #303b50;
            background: #111827;
            color: #fff;
            border-radius: 8px;
            padding: 8px 11px;
        }

        @media (max-width: 1100px) {
            .workspace {
                grid-template-columns: 1fr;
            }

            .result-area,
            .empty-result,
            .loading-state {
                min-height: 400px;
                height: auto;
            }
        }

        @media (max-width: 768px) {
            .sidebar {
                position: fixed;
                left: -290px;
                top: 0;
                bottom: 0;
                z-index: 1000;
                transition: .25s;
            }

            .sidebar.show {
                left: 0;
            }

            .mobile-menu {
                display: block;
            }

            .main-content {
                width: 100%;
                padding: 15px;
            }

            .topbar {
                gap: 10px;
            }

            .page-title {
                font-size: 19px;
            }

            .provider-badge {
                display: none;
            }
        }
    </style>
</head>

<body>

<div class="app-wrapper">

    <!-- =========================
         SIDEBAR
    ========================== -->

    <aside class="sidebar" id="sidebar">

        <div class="brand">

            <div class="brand-icon">
                <i class="fa-solid fa-wand-magic-sparkles"></i>
            </div>

            <div class="brand-text">
                <h5>AI Tools</h5>
                <small>Developer Assistant</small>
            </div>

        </div>

        <div class="sidebar-title">
            AI TOOLS
        </div>

        <div id="toolList">

            <button
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

            <button
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

            <button
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

            <button
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

            <button
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

            <button
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

            <button
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

        <div class="sidebar-bottom">

            <div class="status-box">

                <div>
                    <span class="status-dot"></span>
                    <span style="font-size:12px;color:#d5dbea;">
                        Gemini Connected
                    </span>
                </div>

                <div class="status-text mt-1">
                    AI provider is ready
                </div>

            </div>

        </div>

    </aside>


    <!-- =========================
         MAIN
    ========================== -->

    <main class="main-content">

        <div class="topbar">

            <div class="d-flex align-items-center gap-3">

                <button
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

            <div class="provider-badge">
                <i class="fa-solid fa-circle-check me-1"></i>
                Gemini Online
            </div>

        </div>


        <div class="workspace">

            <!-- =========================
                 INPUT PANEL
            ========================== -->

            <div class="panel">

                <div class="panel-header">

                    <div>
                        <h6>
                            <i class="fa-solid fa-pen-to-square me-2"></i>
                            Workspace
                        </h6>

                        <small>
                            Configure your request
                        </small>
                    </div>

                </div>

                <div class="panel-body">

                    <div class="selected-tool">

                        <div
                            class="selected-tool-icon"
                            id="selectedToolIcon"
                        >
                           <i class="fa-solid fa-star-of-life"></i>
                        </div>

                        <div>

                            <h4 id="selectedToolTitle">
                                Ask AI
                            </h4>

                            <p id="selectedToolDescription">
                                Ask anything about Laravel, PHP, MySQL,
                                JavaScript or development.
                            </p>

                        </div>

                    </div>


                    <!-- Dynamic Form -->

                    <div id="toolForm">

                        <!-- ASK AI -->

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


                        <!-- CODE GENERATOR -->

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
                                        <option>PHP</option>
                                        <option>JavaScript</option>
                                        <option>TypeScript</option>
                                        <option>SQL</option>
                                        <option>HTML</option>
                                        <option>CSS</option>
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
                                        <option>Laravel</option>
                                        <option>CodeIgniter</option>
                                        <option>Node.js</option>
                                        <option>React.js</option>
                                        <option>Vue.js</option>
                                        <option>None</option>
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


                        <!-- DEBUG CODE -->

                        <div
                            class="tool-form d-none"
                            data-form="debug_code"
                        >

                            <div class="row g-3 mb-3">

                                <div class="col-md-6">

                                    <label class="form-label">
                                        Language
                                    </label>

                                    <select
                                        class="form-select"
                                        id="debugLanguage"
                                    >
                                        <option>PHP</option>
                                        <option>JavaScript</option>
                                        <option>SQL</option>
                                        <option>HTML</option>
                                        <option>CSS</option>
                                    </select>

                                </div>

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


                        <!-- EXPLAIN CODE -->

                        <div
                            class="tool-form d-none"
                            data-form="explain_code"
                        >

                            <div class="row g-3 mb-3">

                                <div class="col-md-6">

                                    <label class="form-label">
                                        Language
                                    </label>

                                    <select
                                        class="form-select"
                                        id="explainLanguage"
                                    >
                                        <option>PHP</option>
                                        <option>JavaScript</option>
                                        <option>SQL</option>
                                        <option>HTML</option>
                                        <option>CSS</option>
                                    </select>

                                </div>

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


                        <!-- SQL GENERATOR -->

                        <div
                            class="tool-form d-none"
                            data-form="sql_generator"
                        >

                            <div class="row g-3 mb-3">

                                <div class="col-md-6">

                                    <label class="form-label">
                                        Database
                                    </label>

                                    <select
                                        class="form-select"
                                        id="databaseType"
                                    >
                                        <option>MySQL</option>
                                        <option>PostgreSQL</option>
                                        <option>SQLite</option>
                                        <option>SQL Server</option>
                                    </select>

                                </div>

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


                        <!-- API BUILDER -->

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
                                        <option>GET</option>
                                        <option>POST</option>
                                        <option>PUT</option>
                                        <option>PATCH</option>
                                        <option>DELETE</option>
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


                        <!-- DOCUMENTATION -->

                        <div
                            class="tool-form d-none"
                            data-form="documentation"
                        >

                            <div class="row g-3 mb-3">

                                <div class="col-md-6">

                                    <label class="form-label">
                                        Documentation Format
                                    </label>

                                    <select
                                        class="form-select"
                                        id="documentationFormat"
                                    >
                                        <option>Markdown</option>
                                        <option>HTML</option>
                                        <option>Plain Text</option>
                                        <option>Laravel PHPDoc</option>
                                    </select>

                                </div>

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


                    <!-- ACTIONS -->

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


                    <!-- QUICK ACTIONS -->

                    <div class="quick-actions">

                        <div class="quick-title">
                            Quick examples
                        </div>

                        <div class="quick-list">

                            <button
                                class="quick-chip"
                                data-example="Create Laravel CRUD API"
                            >
                                Laravel CRUD API
                            </button>

                            <button
                                class="quick-chip"
                                data-example="Create Laravel Sanctum authentication"
                            >
                                Sanctum Auth
                            </button>

                            <button
                                class="quick-chip"
                                data-example="Optimize this MySQL query"
                            >
                                Optimize SQL
                            </button>

                            <button
                                class="quick-chip"
                                data-example="Explain Laravel service container"
                            >
                                Explain Laravel
                            </button>

                        </div>

                    </div>

                </div>

            </div>


            <!-- =========================
                 RESULT PANEL
            ========================== -->

            <div class="panel">

                <div class="panel-header">

                    <div>

                        <h6>
                            <i class="fa-solid fa-terminal me-2"></i>
                            AI Result
                        </h6>

                        <small>
                            Generated by Gemini
                        </small>

                    </div>

                    <div class="result-toolbar">

                        <button
                            type="button"
                            class="result-btn"
                            id="copyButton"
                        >
                            <i class="fa-regular fa-copy me-1"></i>
                            Copy
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


                <div class="panel-body result-area">

                    <!-- EMPTY -->

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
                            Select a tool, describe what you need and
                            click Generate to let Gemini build the result.
                        </p>

                    </div>


                    <!-- LOADING -->

                    <div
                        class="loading-state"
                        id="loadingState"
                    >

                        <div class="loader"></div>

                        <span>
                            Gemini is generating your result...
                        </span>

                    </div>


                    <!-- RESULT -->

                    <div
                        class="result-content"
                        id="resultContent"
                    >

                        <pre><code id="resultText"></code></pre>

                    </div>

                </div>

            </div>

        </div>

    </main>

</div>


<script>

    /*
    |--------------------------------------------------------------------------
    | Tool Configuration
    |--------------------------------------------------------------------------
    */

    const tools = {

        ask_ai: {
            title: "Ask AI",
            description:
                "Ask anything about Laravel, PHP, MySQL, JavaScript or development.",
            icon: "fa-solid fa-star-of-life"
        },

        code_generator: {
            title: "Code Generator",
            description:
                "Generate production-ready code based on your requirements.",
            icon: "fa-solid fa-code"
        },

        debug_code: {
            title: "Debug Code",
            description:
                "Find errors, explain the problem and suggest a corrected solution.",
            icon: "fa-solid fa-bug"
        },

        explain_code: {
            title: "Explain Code",
            description:
                "Understand existing code with a clear step-by-step explanation.",
            icon: "fa-solid fa-book-open"
        },

        sql_generator: {
            title: "SQL Generator",
            description:
                "Generate and optimize SQL queries from natural language.",
            icon: "fa-solid fa-database"
        },

        api_builder: {
            title: "API Builder",
            description:
                "Design REST APIs including routes, validation and responses.",
            icon: "fa-solid fa-plug"
        },

        documentation: {
            title: "Documentation",
            description:
                "Generate clean technical documentation for your code.",
            icon: "fa-solid fa-file-lines"
        }

    };


    let currentTool = "ask_ai";
    let lastPrompt = "";


    /*
    |--------------------------------------------------------------------------
    | DOM
    |--------------------------------------------------------------------------
    */

    const toolItems =
        document.querySelectorAll(".tool-item");

    const toolForms =
        document.querySelectorAll(".tool-form");

    const selectedToolTitle =
        document.getElementById("selectedToolTitle");

    const selectedToolDescription =
        document.getElementById("selectedToolDescription");

    const selectedToolIcon =
        document.getElementById("selectedToolIcon");

    const generateButton =
        document.getElementById("generateButton");

    const clearButton =
        document.getElementById("clearButton");

    const copyButton =
        document.getElementById("copyButton");

    const regenerateButton =
        document.getElementById("regenerateButton");

    const emptyResult =
        document.getElementById("emptyResult");

    const loadingState =
        document.getElementById("loadingState");

    const resultContent =
        document.getElementById("resultContent");

    const resultText =
        document.getElementById("resultText");

    const mobileMenu =
        document.getElementById("mobileMenu");

    const sidebar =
        document.getElementById("sidebar");


    /*
    |--------------------------------------------------------------------------
    | Tool Selection
    |--------------------------------------------------------------------------
    */

    toolItems.forEach(item => {

        item.addEventListener("click", function () {

            currentTool =
                this.dataset.tool;

            toolItems.forEach(tool => {
                tool.classList.remove("active");
            });

            this.classList.add("active");

            const tool =
                tools[currentTool];

            selectedToolTitle.innerText =
                tool.title;

            selectedToolDescription.innerText =
                tool.description;

            selectedToolIcon.innerHTML =
                `<i class="${tool.icon}"></i>`;

            toolForms.forEach(form => {

                form.classList.add("d-none");

                if (
                    form.dataset.form === currentTool
                ) {
                    form.classList.remove("d-none");
                }

            });

            clearResult();

            sidebar.classList.remove("show");

        });

    });


    /*
    |--------------------------------------------------------------------------
    | Generate Prompt
    |--------------------------------------------------------------------------
    */

    function buildPrompt() {

        switch (currentTool) {

            case "ask_ai":

                return `
You are an expert software development assistant.

Answer the following question clearly and practically.

Question:
${document.getElementById("askPrompt").value}

Focus on:
- Correctness
- Practical examples
- Laravel/PHP best practices where relevant
- Clear explanation
                `;


            case "code_generator":

                const language =
                    document.getElementById("codeLanguage").value;

                const framework =
                    document.getElementById("codeFramework").value;

                const codePrompt =
                    document.getElementById("codePrompt").value;

                let include = [];

                if (
                    document.getElementById("includeController").checked
                ) {
                    include.push("Controller");
                }

                if (
                    document.getElementById("includeValidation").checked
                ) {
                    include.push("Request validation");
                }

                if (
                    document.getElementById("includeRoute").checked
                ) {
                    include.push("API routes");
                }

                if (
                    document.getElementById("includeModel").checked
                ) {
                    include.push("Model and migration");
                }

                return `
You are an expert software developer.

Generate production-ready code.

Language:
${language}

Framework:
${framework}

Requirement:
${codePrompt}

Include:
${include.join(", ")}

Requirements:
- Follow modern best practices.
- Give complete usable code.
- Explain important parts briefly.
- If Laravel is used, follow Laravel conventions.
- Do not omit important imports.
                `;


            case "debug_code":

                return `
You are an expert debugging assistant.

Language:
${document.getElementById("debugLanguage").value}

Analyze the following code:

${document.getElementById("debugCode").value}

Provide:
1. Identify the error/problem.
2. Explain why it happens.
3. Provide corrected code.
4. Explain the fix.
5. Mention any best-practice improvements.
                `;


            case "explain_code":

                return `
You are an expert programming instructor.

Explain the following
${document.getElementById("explainLanguage").value}
code step by step.

Code:

${document.getElementById("explainCode").value}

Explain:
- What the code does
- Important functions/classes
- Data flow
- Potential problems
- Best practices
                `;


            case "sql_generator":

                return `
You are an expert database developer.

Database:
${document.getElementById("databaseType").value}

Generate the SQL query for:

${document.getElementById("sqlPrompt").value}

Provide:
1. SQL query
2. Explanation
3. Required tables/columns
4. Performance considerations
5. Index recommendations where useful
                `;


            case "api_builder":

                return `
You are an expert REST API developer.

HTTP Method:
${document.getElementById("apiMethod").value}

Endpoint:
${document.getElementById("apiEndpoint").value}

API Description:
${document.getElementById("apiDescription").value}

Create a complete API design including:

- Route
- Controller method
- Request validation
- Authentication considerations
- Request example
- Response example
- Error response
- HTTP status codes

Use Laravel conventions where appropriate.
                `;


            case "documentation":

                return `
You are a technical documentation expert.

Documentation format:
${document.getElementById("documentationFormat").value}

Create professional documentation for:

${document.getElementById("documentationInput").value}

Include:
- Overview
- Purpose
- Parameters
- Usage
- Examples
- Important notes
- Errors/exceptions where relevant
                `;

            default:
                return "";
        }

    }


    /*
    |--------------------------------------------------------------------------
    | Generate
    |--------------------------------------------------------------------------
    */

    generateButton.addEventListener(
        "click",
        generateResult
    );


    async function generateResult() {

        const prompt =
            buildPrompt().trim();

        if (!prompt) {

            alert(
                "Please enter some information first."
            );

            return;
        }

        lastPrompt = prompt;

        setLoading(true);

        try {

            const response =
                await fetch(
                    "{{ route('ai.chat.send') }}",
                    {
                        method: "POST",

                        headers: {

                            "Content-Type":
                                "application/json",

                            "Accept":
                                "application/json",

                            "X-CSRF-TOKEN":
                                document
                                    .querySelector(
                                        'meta[name="csrf-token"]'
                                    )
                                    .getAttribute("content")

                        },

                        body: JSON.stringify({
                            message: prompt
                        })

                    }
                );


            const data =
                await response.json();


            if (!response.ok) {

                throw new Error(
                    data.message ||
                    "Something went wrong."
                );

            }


            showResult(
                data.answer || "No result returned."
            );


        } catch (error) {

            showResult(
                "Error:\n\n" +
                error.message
            );

        } finally {

            setLoading(false);

        }

    }


    /*
    |--------------------------------------------------------------------------
    | Loading
    |--------------------------------------------------------------------------
    */

    function setLoading(status) {

        if (status) {

            emptyResult.style.display =
                "none";

            resultContent.style.display =
                "none";

            loadingState.style.display =
                "flex";

            generateButton.disabled =
                true;

            generateButton.innerHTML =
                `
                <span
                    class="spinner-border spinner-border-sm me-2"
                ></span>
                Generating...
                `;

        } else {

            loadingState.style.display =
                "none";

            generateButton.disabled =
                false;

            generateButton.innerHTML =
                `
                <i class="fa-solid fa-wand-magic-sparkles me-2"></i>
                Generate
                `;

        }

    }


    /*
    |--------------------------------------------------------------------------
    | Show Result
    |--------------------------------------------------------------------------
    */

    function showResult(result) {

        emptyResult.style.display =
            "none";

        resultContent.style.display =
            "block";

        resultText.textContent =
            result;

    }


    /*
    |--------------------------------------------------------------------------
    | Clear
    |--------------------------------------------------------------------------
    */

    clearButton.addEventListener(
        "click",
        function () {

            const form =
                document.querySelector(
                    `[data-form="${currentTool}"]`
                );

            if (form) {

                form
                    .querySelectorAll(
                        "textarea, input"
                    )
                    .forEach(input => {

                        if (
                            input.type === "checkbox"
                        ) {
                            return;
                        }

                        input.value = "";

                    });

            }

            clearResult();

        }
    );


    function clearResult() {

        resultText.textContent = "";

        resultContent.style.display =
            "none";

        loadingState.style.display =
            "none";

        emptyResult.style.display =
            "flex";

    }


    /*
    |--------------------------------------------------------------------------
    | Copy
    |--------------------------------------------------------------------------
    */

    copyButton.addEventListener(
        "click",
        async function () {

            const text =
                resultText.textContent;

            if (!text) {
                return;
            }

            try {

                await navigator.clipboard.writeText(
                    text
                );

                const original =
                    copyButton.innerHTML;

                copyButton.innerHTML =
                    `
                    <i class="fa-solid fa-check me-1"></i>
                    Copied
                    `;

                setTimeout(() => {

                    copyButton.innerHTML =
                        original;

                }, 1500);

            } catch (error) {

                alert(
                    "Unable to copy result."
                );

            }

        }
    );


    /*
    |--------------------------------------------------------------------------
    | Regenerate
    |--------------------------------------------------------------------------
    */

    regenerateButton.addEventListener(
        "click",
        function () {

            if (!lastPrompt) {

                alert(
                    "Generate something first."
                );

                return;

            }

            generateResult();

        }
    );


    /*
    |--------------------------------------------------------------------------
    | Quick Examples
    |--------------------------------------------------------------------------
    */

    document
        .querySelectorAll(".quick-chip")
        .forEach(chip => {

            chip.addEventListener(
                "click",
                function () {

                    const example =
                        this.dataset.example;

                    if (
                        currentTool === "ask_ai"
                    ) {

                        document
                            .getElementById(
                                "askPrompt"
                            )
                            .value =
                            example;

                    }

                    if (
                        currentTool ===
                        "code_generator"
                    ) {

                        document
                            .getElementById(
                                "codePrompt"
                            )
                            .value =
                            example;

                    }

                    if (
                        currentTool ===
                        "sql_generator"
                    ) {

                        document
                            .getElementById(
                                "sqlPrompt"
                            )
                            .value =
                            example;

                    }

                }
            );

        });


    /*
    |--------------------------------------------------------------------------
    | Mobile Sidebar
    |--------------------------------------------------------------------------
    */

    mobileMenu.addEventListener(
        "click",
        function () {

            sidebar.classList.toggle(
                "show"
            );

        }
    );


    /*
    |--------------------------------------------------------------------------
    | Keyboard Shortcut
    |--------------------------------------------------------------------------
    */

    document.addEventListener(
        "keydown",
        function (event) {

            if (
                event.ctrlKey &&
                event.key === "Enter"
            ) {

                generateResult();

            }

        }
    );

</script>

</body>
</html>
