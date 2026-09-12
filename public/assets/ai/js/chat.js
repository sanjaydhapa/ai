

    /* =========================================================
       TOOL CONFIGURATION
    ========================================================= */

    const tools = {

        ask_ai: {

            title: "Ask AI",

            description:
                "Ask anything about Laravel, PHP, MySQL, JavaScript or development.",

            icon:
                "fa-solid fa-star-of-life"

        },


        code_generator: {

            title: "Code Generator",

            description:
                "Generate production-ready code based on your requirements.",

            icon:
                "fa-solid fa-code"

        },


        debug_code: {

            title: "Debug Code",

            description:
                "Find errors, explain the problem and suggest a corrected solution.",

            icon:
                "fa-solid fa-bug"

        },


        explain_code: {

            title: "Explain Code",

            description:
                "Understand existing code with a clear step-by-step explanation.",

            icon:
                "fa-solid fa-book-open"

        },


        sql_generator: {

            title: "SQL Generator",

            description:
                "Generate and optimize SQL queries from natural language.",

            icon:
                "fa-solid fa-database"

        },


        api_builder: {

            title: "API Builder",

            description:
                "Design REST APIs including routes, validation and responses.",

            icon:
                "fa-solid fa-plug"

        },


        documentation: {

            title: "Documentation",

            description:
                "Generate clean technical documentation for your code.",

            icon:
                "fa-solid fa-file-lines"

        }

    };


    /* =========================================================
       STATE
    ========================================================= */

    let currentTool = "ask_ai";

    let lastPrompt = "";

    let lastRawResult = "";


    /* =========================================================
       DOM
    ========================================================= */

    const toolItems =
        document.querySelectorAll(".tool-item");


    const toolForms =
        document.querySelectorAll(".tool-form");


    const selectedToolTitle =
        document.getElementById(
            "selectedToolTitle"
        );


    const selectedToolDescription =
        document.getElementById(
            "selectedToolDescription"
        );


    const selectedToolIcon =
        document.getElementById(
            "selectedToolIcon"
        );


    const generateButton =
        document.getElementById(
            "generateButton"
        );


    const clearButton =
        document.getElementById(
            "clearButton"
        );


    const copyAllButton =
        document.getElementById(
            "copyAllButton"
        );


    const regenerateButton =
        document.getElementById(
            "regenerateButton"
        );


    const emptyResult =
        document.getElementById(
            "emptyResult"
        );


    const loadingState =
        document.getElementById(
            "loadingState"
        );


    const resultContent =
        document.getElementById(
            "resultContent"
        );


    const resultScroll =
        document.getElementById(
            "resultScroll"
        );


    const mobileMenu =
        document.getElementById(
            "mobileMenu"
        );


    const sidebar =
        document.getElementById(
            "sidebar"
        );


    /* =========================================================
       TOOL SELECTION
    ========================================================= */

    toolItems.forEach(item => {

        item.addEventListener(
            "click",
            function () {

                currentTool =
                    this.dataset.tool;


                /* Active */

                toolItems.forEach(tool => {

                    tool.classList.remove(
                        "active"
                    );

                });


                this.classList.add(
                    "active"
                );


                /* Tool Information */

                const tool =
                    tools[currentTool];


                selectedToolTitle.innerText =
                    tool.title;


                selectedToolDescription.innerText =
                    tool.description;


                selectedToolIcon.innerHTML =
                    `<i class="${tool.icon}"></i>`;


                /* Show selected form */

                toolForms.forEach(form => {

                    form.classList.add(
                        "d-none"
                    );


                    if (
                        form.dataset.form ===
                        currentTool
                    ) {

                        form.classList.remove(
                            "d-none"
                        );

                    }

                });


                /* Clear previous result */

                clearResult();


                /* Close mobile sidebar */

                sidebar.classList.remove(
                    "show"
                );

            }
        );

    });


    /* =========================================================
       BUILD AI PROMPT
    ========================================================= */

    function buildPrompt() {


        switch (currentTool) {


            /* =========================================
               ASK AI
            ========================================= */

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
- Production-ready recommendations

When providing code, ALWAYS use Markdown fenced code blocks with
the correct language identifier.

Example:

\`\`\`php
// code
\`\`\`

`;


            /* =========================================
               CODE GENERATOR
            ========================================= */

            case "code_generator":


                const language =
                    document.getElementById(
                        "codeLanguage"
                    ).value;


                const framework =
                    document.getElementById(
                        "codeFramework"
                    ).value;


                const codePrompt =
                    document.getElementById(
                        "codePrompt"
                    ).value;


                let include = [];


                if (
                    document.getElementById(
                        "includeController"
                    ).checked
                ) {

                    include.push(
                        "Controller"
                    );

                }


                if (
                    document.getElementById(
                        "includeValidation"
                    ).checked
                ) {

                    include.push(
                        "Request validation"
                    );

                }


                if (
                    document.getElementById(
                        "includeRoute"
                    ).checked
                ) {

                    include.push(
                        "API routes"
                    );

                }


                if (
                    document.getElementById(
                        "includeModel"
                    ).checked
                ) {

                    include.push(
                        "Model and migration"
                    );

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
- Do not omit important imports.
- Explain important parts briefly.
- If Laravel is used, follow Laravel conventions.
- Use separate Markdown fenced code blocks for each file.
- Always specify the language after the opening backticks.

For example:

\`\`\`php
// Controller
\`\`\`

\`\`\`php
// Model
\`\`\`

\`\`\`php
// Route
\`\`\`

`;


            /* =========================================
               DEBUG
            ========================================= */

            case "debug_code":


                return `

You are an expert debugging assistant.

Language:

${document.getElementById(
    "debugLanguage"
).value}

Analyze the following code:

\`\`\`
${document.getElementById(
    "debugCode"
).value}
\`\`\`

Provide:

1. Identify the error/problem.
2. Explain why it happens.
3. Provide corrected code.
4. Explain the fix.
5. Mention best-practice improvements.

Always put corrected code inside a Markdown fenced code block.

`;


            /* =========================================
               EXPLAIN
            ========================================= */

            case "explain_code":


                return `

You are an expert programming instructor.

Explain the following
${document.getElementById(
    "explainLanguage"
).value}
code step by step.

Code:

\`\`\`
${document.getElementById(
    "explainCode"
).value}
\`\`\`

Explain:

- What the code does
- Important functions/classes
- Data flow
- Potential problems
- Best practices

Keep code examples inside Markdown fenced code blocks.

`;


            /* =========================================
               SQL
            ========================================= */

            case "sql_generator":


                return `

You are an expert database developer.

Database:

${document.getElementById(
    "databaseType"
).value}

Generate the SQL query for:

${document.getElementById(
    "sqlPrompt"
).value}

Provide:

1. SQL query
2. Explanation
3. Required tables/columns
4. Performance considerations
5. Index recommendations where useful

Always put SQL inside a fenced SQL code block:

\`\`\`sql
SELECT ...
\`\`\`

`;


            /* =========================================
               API
            ========================================= */

            case "api_builder":


                return `

You are an expert REST API developer.

HTTP Method:

${document.getElementById(
    "apiMethod"
).value}

Endpoint:

${document.getElementById(
    "apiEndpoint"
).value}

API Description:

${document.getElementById(
    "apiDescription"
).value}

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

Put every code example inside its own fenced code block.

`;


            /* =========================================
               DOCUMENTATION
            ========================================= */

            case "documentation":


                return `

You are a technical documentation expert.

Documentation format:

${document.getElementById(
    "documentationFormat"
).value}

Create professional documentation for:

${document.getElementById(
    "documentationInput"
).value}

Include:

- Overview
- Purpose
- Parameters
- Usage
- Examples
- Important notes
- Errors/exceptions where relevant

Put all code examples inside separate fenced code blocks.

`;


            default:

                return "";

        }

    }


    /* =========================================================
       GENERATE BUTTON
    ========================================================= */

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


        lastPrompt =
            prompt;


        setLoading(true);


        try {


            const response =
                await fetch(
                    window.aiChatSendUrl,
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
                                    .getAttribute(
                                        "content"
                                    )

                        },

                        body:
                            JSON.stringify({
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


            lastRawResult =
                data.answer ||
                "No result returned.";


            showResult(
                lastRawResult
            );


        } catch (error) {


            lastRawResult =
                "Error:\n\n" +
                error.message;


            showResult(
                lastRawResult
            );


        } finally {


            setLoading(false);

        }

    }


    /* =========================================================
       LOADING
    ========================================================= */

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

                <i
                    class="fa-solid fa-wand-magic-sparkles me-2"
                ></i>

                Generate

                `;

        }

    }


    /* =========================================================
       SHOW RESULT
    ========================================================= */

    function showResult(result) {


        emptyResult.style.display =
            "none";


        loadingState.style.display =
            "none";


        resultContent.style.display =
            "block";


        resultScroll.innerHTML =
            formatAIResponse(result);

    }


    /* =========================================================
       FORMAT AI RESPONSE

       Detects:

       Text

       ```php
       code
       ```

       ```javascript
       code
       ```

       ```sql
       code
       ```

       and creates separate copy buttons.
    ========================================================= */

    function formatAIResponse(text) {


        const codeBlockRegex =
            /```([a-zA-Z0-9_+#.-]+)?\s*([\s\S]*?)```/g;


        let html = "";

        let lastIndex = 0;

        let codeIndex = 0;

        let match;


        while (
            (match =
                codeBlockRegex.exec(text))
            !== null
        ) {


            /* =========================================
               TEXT BEFORE CODE
            ========================================= */

            const normalText =
                text
                    .substring(
                        lastIndex,
                        match.index
                    )
                    .trim();


            if (normalText) {


                html += `

                    <div class="ai-text">

                        ${formatNormalText(
                            normalText
                        )}

                    </div>

                `;

            }


            /* =========================================
               CODE
            ========================================= */

            const language =
                match[1] ||
                "code";


            const code =
                match[2]
                    .replace(/^\n/, "")
                    .replace(/\n$/, "");


            const codeId =
                "codeBlock_" +
                codeIndex;


            html += `

                <div class="code-block-wrapper">


                    <div class="code-header">


                        <span class="code-language">

                            <i
                                class="fa-solid fa-code"
                            ></i>

                            ${escapeHtml(
                                language
                            )}

                        </span>


                        <button
                            type="button"
                            class="copy-code-btn"
                            data-code-id="${codeId}"
                        >

                            <i
                                class="fa-regular fa-copy me-1"
                            ></i>

                            Copy Code

                        </button>


                    </div>


                    <pre class="code-block"><code id="${codeId}">${escapeHtml(
                        code
                    )}</code></pre>


                </div>

            `;


            codeIndex++;


            lastIndex =
                codeBlockRegex.lastIndex;

        }


        /* =========================================
           REMAINING TEXT
        ========================================= */

        const remainingText =
            text
                .substring(lastIndex)
                .trim();


        if (remainingText) {


            html += `

                <div class="ai-text">

                    ${formatNormalText(
                        remainingText
                    )}

                </div>

            `;

        }


        return html;

    }


    /* =========================================================
       NORMAL TEXT FORMAT
    ========================================================= */

    function formatNormalText(text) {


        let escaped =
            escapeHtml(text);


        /*
        Convert **bold**
        */

        escaped =
            escaped.replace(
                /\*\*(.*?)\*\*/g,
                "<strong>$1</strong>"
            );


        /*
        Convert `inline code`
        */

        escaped =
            escaped.replace(
                /`([^`]+)`/g,
                "<code style=\"padding:2px 5px;border-radius:4px;background:#0c1424;color:#a5b4fc;\">$1</code>"
            );


        /*
        Convert new lines
        */

        escaped =
            escaped.replace(
                /\n/g,
                "<br>"
            );


        return escaped;

    }


    /* =========================================================
       HTML ESCAPE

       IMPORTANT:
       Prevents Gemini output from being
       inserted as executable HTML.
    ========================================================= */

    function escapeHtml(text) {


        const div =
            document.createElement(
                "div"
            );


        div.textContent =
            text;


        return div.innerHTML;

    }


    /* =========================================================
       COPY INDIVIDUAL CODE BLOCK
    ========================================================= */

    document.addEventListener(
        "click",
        async function(event) {


            const button =
                event.target.closest(
                    ".copy-code-btn"
                );


            if (!button) {

                return;

            }


            const codeId =
                button.dataset.codeId;


            const codeElement =
                document.getElementById(
                    codeId
                );


            if (!codeElement) {

                return;

            }


            const code =
                codeElement.textContent;


            try {


                await navigator.clipboard.writeText(
                    code
                );


                button.innerHTML =
                    `

                    <i
                        class="fa-solid fa-check me-1"
                    ></i>

                    Copied

                    `;


                setTimeout(
                    function () {


                        button.innerHTML =
                            `

                            <i
                                class="fa-regular fa-copy me-1"
                            ></i>

                            Copy Code

                            `;


                    },
                    1500
                );


            } catch (error) {


                alert(
                    "Unable to copy code."
                );

            }

        }
    );


    /* =========================================================
       COPY ALL RESULT
    ========================================================= */

    copyAllButton.addEventListener(
        "click",
        async function () {


            if (!lastRawResult) {

                return;

            }


            try {


                await navigator.clipboard.writeText(
                    lastRawResult
                );


                const original =
                    copyAllButton.innerHTML;


                copyAllButton.innerHTML =
                    `

                    <i
                        class="fa-solid fa-check me-1"
                    ></i>

                    Copied

                    `;


                setTimeout(
                    function () {

                        copyAllButton.innerHTML =
                            original;

                    },
                    1500
                );


            } catch (error) {


                alert(
                    "Unable to copy result."
                );

            }

        }
    );


    /* =========================================================
       REGENERATE
    ========================================================= */

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


    /* =========================================================
       CLEAR
    ========================================================= */

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
                    .forEach(
                        function (input) {


                            if (
                                input.type ===
                                "checkbox"
                            ) {

                                return;

                            }


                            input.value =
                                "";

                        }
                    );

            }


            clearResult();

        }
    );


    /* =========================================================
       CLEAR RESULT
    ========================================================= */

    function clearResult() {


        lastRawResult =
            "";


        resultScroll.innerHTML =
            "";


        resultContent.style.display =
            "none";


        loadingState.style.display =
            "none";


        emptyResult.style.display =
            "flex";

    }


    /* =========================================================
       QUICK EXAMPLES
    ========================================================= */

    document
        .querySelectorAll(
            ".quick-chip"
        )
        .forEach(
            function (chip) {


                chip.addEventListener(
                    "click",
                    function () {


                        const example =
                            this.dataset.example;


                        if (
                            currentTool ===
                            "ask_ai"
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

            }
        );


    /* =========================================================
       MOBILE SIDEBAR
    ========================================================= */

    mobileMenu.addEventListener(
        "click",
        function () {


            sidebar.classList.toggle(
                "show"
            );

        }
    );


    /* =========================================================
       CTRL + ENTER
    ========================================================= */

    document.addEventListener(
        "keydown",
        function (event) {


            if (
                event.ctrlKey &&
                event.key === "Enter"
            ) {


                event.preventDefault();


                generateResult();

            }

        }
    );


