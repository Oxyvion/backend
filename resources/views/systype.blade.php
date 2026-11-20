<!doctype html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="theme-color" content="#0b0e12">
    <title>SysType · Práctica de escritura</title>
    <!-- Los estilos de esta página construyen la interfaz SysType con tema oscuro adaptable. -->
    <style>
        :root{color-scheme:dark;--base:#0b0e12;--surface:#111820;--deep:#080d12;--line:#263544;--text:#edf5fc;--muted:#96abc0;--cyan:#20cfe3;--violet:#7c5cff;--green:#38d99a;--red:#ff8493}
        *{box-sizing:border-box}body{margin:0;min-width:320px;min-height:100vh;background:var(--base);color:var(--text);font:16px Inter,ui-sans-serif,system-ui,"Segoe UI",sans-serif}button,input,select{font:inherit}button{cursor:pointer}button:disabled{cursor:not-allowed;opacity:.55}[hidden]{display:none!important}
        .topbar{position:sticky;top:0;z-index:5;min-height:78px;display:flex;align-items:center;justify-content:space-between;gap:18px;padding:10px clamp(18px,5vw,78px);border-bottom:1px solid var(--line);background:rgb(11 14 18 / 96%);backdrop-filter:blur(12px)}.topbar.app-header{display:grid;grid-template-columns:minmax(250px,1fr) auto minmax(250px,1fr)}.brand{display:flex;align-items:center;gap:11px;color:var(--text);font-size:1.55rem;font-weight:850;letter-spacing:-.05em;text-decoration:none;white-space:nowrap}.brand-icon{width:48px;height:48px;display:grid;place-items:center;border:1px solid var(--violet);border-radius:13px;background:var(--deep);color:var(--cyan);font-size:1.4rem}.brand em{color:var(--cyan);font-style:normal}.nav{display:flex;align-items:center;justify-self:center;gap:5px;margin:0}.nav button{padding:10px 13px;border:0;border-radius:8px;background:transparent;color:var(--muted);font-weight:700}.nav button:hover,.nav button.active{background:#10262d;color:var(--cyan)}.userbar{display:flex;align-items:center;justify-self:end;gap:12px;color:var(--cyan);font-weight:750}
        .button{min-height:43px;display:inline-flex;align-items:center;justify-content:center;gap:8px;padding:0 17px;border:1px solid transparent;border-radius:9px;font-weight:800}.primary{background:var(--cyan);color:#071015}.outline{border-color:var(--cyan);background:transparent;color:var(--cyan)}.secondary{border-color:var(--line);background:var(--surface);color:var(--text)}.button:hover{filter:brightness(1.1);transform:translateY(-1px)}
        main{width:min(100% - 36px,1240px);margin:auto;padding:35px 0 70px}.hero{padding:38px 0 30px}.eyebrow{margin:0 0 13px;color:var(--cyan);font-size:.76rem;font-weight:850;letter-spacing:.15em;text-transform:uppercase}.hero h1{max-width:820px;margin:0 0 15px;font-size:clamp(2.4rem,6vw,4.5rem);line-height:1.05;letter-spacing:-.06em}.hero p:not(.eyebrow){max-width:700px;color:var(--muted);font-size:1.12rem;line-height:1.7}.grid{display:grid;grid-template-columns:minmax(0,1fr) minmax(300px,.8fr);gap:18px;align-items:start}.card{padding:clamp(20px,3vw,30px);border:1px solid var(--line);border-radius:16px;background:var(--surface)}.card h2{margin:6px 0 22px;font-size:1.4rem}.label{display:grid;gap:8px;margin:0 0 16px;color:#c4d3e2;font-size:.9rem;font-weight:700}input,select{width:100%;min-height:46px;padding:0 13px;border:1px solid #314252;border-radius:10px;outline:0;background:var(--deep);color:var(--text)}input:focus,select:focus{border-color:var(--cyan);box-shadow:0 0 0 3px rgb(32 207 227 / 14%)}.preview{margin:17px 0;padding:17px;border:1px solid var(--line);border-radius:12px;background:var(--deep);color:#c4d3e2;line-height:1.7}.preview-meta{display:flex;gap:12px;color:var(--cyan);font-size:.82rem;font-weight:800}.preview p{margin-bottom:0}.stats{display:grid;grid-template-columns:repeat(3,1fr);gap:10px}.stat{padding:17px;border:1px solid var(--line);border-radius:12px;background:var(--deep)}.stat span{display:block;color:var(--muted);font-size:.85rem}.stat strong{display:block;margin-top:7px;color:var(--cyan);font-size:1.5rem}
        .auth-wrap{min-height:calc(100vh - 76px);display:grid;place-items:center;padding:30px 16px}.auth-card{width:min(100%,520px);padding:clamp(24px,5vw,42px);border:1px solid var(--line);border-radius:19px;background:var(--surface)}.auth-card h1{margin:6px 0 8px;color:var(--cyan);font-size:2.3rem}.muted{color:var(--muted);line-height:1.65}.auth-switch{display:grid;grid-template-columns:1fr 1fr;gap:5px;margin:24px 0;padding:5px;border-radius:11px;background:var(--deep)}.auth-switch button{min-height:42px;border:0;border-radius:8px;background:transparent;color:var(--muted);font-weight:750}.auth-switch .selected{background:#17232d;color:var(--text)}.form{display:grid;gap:14px}.notice{margin:0;padding:12px 14px;border:1px solid #713940;border-radius:10px;background:#28191d;color:#ffb5bb}.notice.ok{border-color:#17654c;background:#10241d;color:#78e6b5}
        .practice-card{padding:clamp(18px,4vw,36px)}.metrics{display:grid;grid-template-columns:repeat(4,1fr);gap:10px;margin-bottom:22px;padding:15px;border-radius:12px;background:var(--deep)}.metrics div{display:grid;justify-items:center;gap:5px}.metrics span{color:var(--muted);font-size:.82rem}.metrics strong{color:var(--cyan);font-size:1.2rem}.practice-title{color:var(--cyan);font-size:clamp(1.5rem,4vw,2.2rem)}.hint{margin:0 0 10px;color:var(--muted);font-size:.9rem}.hint.error{color:var(--red);font-weight:750}.typing-stage{position:relative;margin:10px 0 18px}.target{min-height:160px;padding:20px;border:1px solid var(--line);border-radius:13px;background:var(--deep);font:clamp(1rem,2.1vw,1.2rem)/1.9 ui-monospace,SFMono-Regular,Consolas,monospace;white-space:pre-wrap;overflow-wrap:anywhere;cursor:text}.target .correct{color:var(--green)}.target .current{border-bottom:2px solid var(--cyan)}.capture{position:absolute;inset:0;width:100%;height:100%;min-height:100%;padding:20px;border:0;border-radius:13px;opacity:.01;color:transparent;caret-color:transparent;background:transparent;font:inherit;line-height:1.9;resize:none}.capture:focus{outline:0;box-shadow:none}.practice-actions{display:flex;justify-content:space-between;gap:12px;color:var(--muted);font-size:.9rem}.results{width:100%;border-collapse:collapse;text-align:left}.results th,.results td{padding:14px 10px;border-bottom:1px solid var(--line)}.results th{color:var(--cyan);font-size:.85rem}.results td{color:#d4e0eb}.empty{padding:18px 0;color:var(--muted)}
        @media(max-width:850px){.topbar.app-header{grid-template-columns:minmax(0,1fr) auto;row-gap:4px}.topbar.app-header .nav{grid-column:1/-1;grid-row:2;justify-self:stretch;width:100%;overflow:auto}.topbar.app-header .userbar{grid-column:2;grid-row:1}.grid{grid-template-columns:1fr}}@media(max-width:560px){.userbar span{display:none}.topbar{padding-inline:14px}.brand{font-size:1.25rem}.brand-icon{width:48px;height:48px}.nav button{padding:8px 10px;font-size:.84rem}.metrics{grid-template-columns:repeat(2,1fr)}.practice-actions{flex-direction:column}}
    </style>
</head>
<body>
<!-- Aquí JavaScript renderiza la página activa según el estado de sesión del estudiante. -->
<div id="app"></div>
<script>
(() => {
    // Configuración y estado temporal de la sesión, biblioteca, práctica y cronómetro.
    const api = '/api/v1';
    const tokenKey = 'systype-main-token';
    const app = document.querySelector('#app');
    let token = localStorage.getItem(tokenKey);
    let user = null;
    let categories = [];
    let exercises = [];
    let currentExercise = null;
    let typed = '';
    let mistakes = 0;
    let startedAt = null;
    let timer = null;
    let saving = false;

    // Escapa valores que vienen de la API antes de insertarlos en el HTML de la página.
    const escapeHtml = (value) => String(value ?? '').replace(/[&<>"']/g, (char) => ({'&':'&amp;','<':'&lt;','>':'&gt;','"':'&quot;',"'":'&#39;'}[char]));
    // Envía peticiones al backend Laravel y convierte respuestas HTTP fallidas en errores legibles.
    async function request(path, options = {}) {
        const headers = { Accept: 'application/json', ...options.headers };
        if (options.body) headers['Content-Type'] = 'application/json';
        if (token && options.auth !== false) headers.Authorization = `Bearer ${token}`;
        const response = await fetch(api + path, { method: options.method || 'GET', headers, body: options.body ? JSON.stringify(options.body) : undefined });
        const payload = await response.json().catch(() => ({}));
        if (!response.ok) { const firstError = Object.values(payload.errors || {}).flat()[0]; throw new Error(firstError || payload.message || `Error ${response.status}`); }
        return payload;
    }
    // Devuelve el logotipo reutilizable del proyecto.
    function brand() { return '<a class="brand" href="#inicio"><span class="brand-icon">⌨</span><span>Sys<em>Type</em></span></a>'; }
    // Detiene el cronómetro para que no siga actualizando cuando se cambia de pantalla.
    function stopTimer() { if (timer) { clearInterval(timer); timer = null; } }
    // Construye la barra superior y marca la pestaña actual.
    function header(active = '') {
        return `<header class="topbar app-header">${brand()}<nav class="nav"><button data-page="home" class="${active === 'home' ? 'active' : ''}">Inicio</button><button data-page="practice" class="${active === 'practice' ? 'active' : ''}">Practicar</button><button data-page="progress" class="${active === 'progress' ? 'active' : ''}">Mi progreso</button></nav><div class="userbar"><span>${escapeHtml(user?.name)}</span><button id="logout" class="button outline">Cerrar sesión</button></div></header>`;
    }
    // Conecta los botones de navegación y cierre de sesión con sus acciones.
    function bindHeader() {
        app.querySelectorAll('[data-page]').forEach((button) => button.addEventListener('click', () => {
            if (button.dataset.page === 'home') renderHome();
            if (button.dataset.page === 'practice') renderPracticePicker();
            if (button.dataset.page === 'progress') renderProgress();
        }));
        app.querySelector('#logout')?.addEventListener('click', logout);
    }
    // Dibuja la página pública inicial con accesos a registro e inicio de sesión.
    function renderLanding() {
        app.innerHTML = `<header class="topbar">${brand()}<div class="userbar"><button class="button outline" data-auth="login">Iniciar sesión</button><button class="button primary" data-auth="register">Registrarse</button></div></header><main><section class="hero"><p class="eyebrow">MECANOGRAFÍA PARA INGENIERÍA DE SISTEMAS</p><h1>Domina la teoría de sistemas a la velocidad de tus dedos</h1><p>Practica conceptos de Ingeniería de Sistemas, mejora tu precisión y avanza a tu propio ritmo.</p><button class="button primary" data-auth="register">Comenzar ahora →</button></section><section class="grid"><article class="card"><p class="eyebrow">SYSTYPE</p><h2>Practica a tu propio ritmo</h2><p class="muted">Completa ejercicios, mejora tu precisión y consulta tu progreso cuando quieras.</p></article><article class="card"><p class="eyebrow">TU CUENTA</p><h2>Guarda tus avances</h2><p class="muted">Inicia sesión para practicar y conservar tus resultados.</p></article></section></main>`;
        app.querySelectorAll('[data-auth]').forEach((button) => button.addEventListener('click', () => renderAuth(button.dataset.auth)));
    }
    // Dibuja el formulario de acceso o registro y procesa sus datos con la API.
    function renderAuth(mode = 'login') {
        const register = mode === 'register';
        app.innerHTML = `<main class="auth-wrap"><section class="auth-card">${brand()}<p class="eyebrow" style="margin-top:28px">SYSTYPE · PRÁCTICA DE ESCRITURA</p><h1>${register ? 'Crear cuenta' : 'Iniciar sesión'}</h1><p class="muted">${register ? 'Regístrate para comenzar a practicar.' : 'Continúa mejorando tu velocidad y precisión.'}</p><div class="auth-switch"><button data-mode="login" class="${register ? '' : 'selected'}">Iniciar sesión</button><button data-mode="register" class="${register ? 'selected' : ''}">Registrarme</button></div><form id="auth-form" class="form">${register ? '<label class="label">Nombre<input name="name" minlength="2" maxlength="100" autocomplete="name" required></label>' : ''}<label class="label">Correo electrónico<input name="email" type="email" autocomplete="email" required></label><label class="label">Contraseña<input name="password" type="password" minlength="8" autocomplete="${register ? 'new-password' : 'current-password'}" required></label>${register ? '<label class="label">Confirmar contraseña<input name="password_confirmation" type="password" minlength="8" autocomplete="new-password" required></label>' : ''}<p id="auth-error" class="notice" hidden></p><button id="auth-submit" class="button primary">${register ? 'Crear cuenta' : 'Iniciar sesión'}</button><button id="auth-back" class="button secondary" type="button">Volver al inicio</button></form></section></main>`;
        app.querySelectorAll('[data-mode]').forEach((button) => button.addEventListener('click', () => renderAuth(button.dataset.mode)));
        app.querySelector('#auth-back').addEventListener('click', renderLanding);
        app.querySelector('#auth-form').addEventListener('submit', async (event) => {
            event.preventDefault(); const submit = app.querySelector('#auth-submit'); submit.disabled = true;
            const body = Object.fromEntries(new FormData(event.currentTarget).entries());
            try {
                const result = await request(register ? '/auth/register' : '/auth/login', { method: 'POST', body, auth: false });
                token = result.data.token; user = result.data.user; localStorage.setItem(tokenKey, token); await renderHome();
            } catch (error) { const notice = app.querySelector('#auth-error'); notice.textContent = error.message; notice.hidden = false; submit.disabled = false; }
        });
    }
    // Consulta categorías, ejercicios y perfil; Promise.all carga las tres solicitudes en paralelo.
    async function loadLibrary() {
        const [categoryResponse, exerciseResponse, userResponse] = await Promise.all([request('/categories'), request('/exercises'), request('/me')]);
        categories = categoryResponse.data; exercises = exerciseResponse.data; user = userResponse.data;
    }
    // Presenta el inicio privado, la selección rápida de ejercicios y el resumen de progreso.
    async function renderHome() {
        stopTimer(); app.innerHTML = '<main class="auth-wrap"><p class="muted">Cargando SysType…</p></main>';
        try {
            await loadLibrary();
            app.innerHTML = `${header('home')}<main><section class="hero"><p class="eyebrow">MECANOGRAFÍA PARA INGENIERÍA DE SISTEMAS</p><h1>Practica a tu ritmo, ${escapeHtml(user.name)}.</h1><p>Elige una categoría y un ejercicio para fortalecer tu velocidad y precisión.</p><button id="go-practice" class="button primary">Comenzar a practicar →</button></section><section class="grid"><article class="card"><p class="eyebrow">BIBLIOTECA</p><h2>Elige tu ejercicio</h2><label class="label">Categoría<select id="category-select"><option value="">Todas las categorías</option>${categories.map((item) => `<option value="${item.id}">${escapeHtml(item.name)}</option>`).join('')}</select></label><label class="label">Ejercicio<select id="exercise-select"></select></label><div id="exercise-preview" class="preview"></div><button id="start-practice" class="button primary">Practicar</button></article><article class="card"><p class="eyebrow">TU PROGRESO</p><h2>Continúa mejorando</h2><p class="muted">Tus prácticas terminadas y sus resultados quedan guardados en tu cuenta.</p><button id="go-progress" class="button secondary">Ver mi progreso</button></article></section></main>`;
            bindHeader();
            app.querySelector('#category-select').addEventListener('change', updateExerciseOptions);
            app.querySelector('#exercise-select').addEventListener('change', updatePreview);
            app.querySelector('#start-practice').addEventListener('click', () => startPractice(Number(app.querySelector('#exercise-select').value)));
            app.querySelector('#go-practice').addEventListener('click', renderPracticePicker);
            app.querySelector('#go-progress').addEventListener('click', renderProgress);
            updateExerciseOptions();
        } catch (error) { handleLoadError(error); }
    }
    // Filtra los ejercicios cuando cambia la categoría seleccionada.
    function updateExerciseOptions() {
        const categoryId = Number(app.querySelector('#category-select').value);
        const visible = categoryId ? exercises.filter((item) => item.category_id === categoryId) : exercises;
        const select = app.querySelector('#exercise-select');
        select.innerHTML = visible.map((item) => `<option value="${item.id}">${escapeHtml(item.title)}</option>`).join('');
        select.disabled = !visible.length; app.querySelector('#start-practice').disabled = !visible.length;
        if (visible.length) updatePreview(); else app.querySelector('#exercise-preview').textContent = 'No hay ejercicios en esta categoría.';
    }
    // Actualiza la ficha con contenido, categoría y dificultad del ejercicio elegido.
    function updatePreview() {
        const exercise = exercises.find((item) => item.id === Number(app.querySelector('#exercise-select').value));
        if (!exercise) return;
        app.querySelector('#exercise-preview').innerHTML = `<div class="preview-meta"><span>${escapeHtml(exercise.category)}</span><span>${escapeHtml(exercise.difficulty)}</span></div><p>${escapeHtml(exercise.content)}</p>`;
    }
    // Muestra el selector de ejercicios que inicia una práctica de escritura.
    async function renderPracticePicker() {
        stopTimer();
        try { await loadLibrary(); } catch (error) { handleLoadError(error); return; }
        app.innerHTML = `${header('practice')}<main><section class="hero"><p class="eyebrow">PRÁCTICA</p><h1>Elige un ejercicio</h1><p>Selecciona un texto; después escribe sobre él. Debes corregir cada error antes de avanzar.</p></section><section class="card"><label class="label">Categoría<select id="category-select"><option value="">Todas las categorías</option>${categories.map((item) => `<option value="${item.id}">${escapeHtml(item.name)}</option>`).join('')}</select></label><label class="label">Ejercicio<select id="exercise-select"></select></label><div id="exercise-preview" class="preview"></div><button id="start-practice" class="button primary">Comenzar</button></section></main>`;
        bindHeader(); app.querySelector('#category-select').addEventListener('change', updateExerciseOptions); app.querySelector('#exercise-select').addEventListener('change', updatePreview); app.querySelector('#start-practice').addEventListener('click', () => startPractice(Number(app.querySelector('#exercise-select').value))); updateExerciseOptions();
    }
    // Prepara una sesión nueva y monta el texto objetivo con una captura de teclado superpuesta.
    function startPractice(id) {
        currentExercise = exercises.find((item) => item.id === Number(id)); if (!currentExercise) return;
        typed = ''; mistakes = 0; startedAt = null; saving = false; stopTimer();
        const length = Array.from(currentExercise.content).length;
        app.innerHTML = `${header('practice')}<main><section class="practice-card"><button id="back-practice" class="button secondary">← Volver a ejercicios</button><div style="margin:20px 0"><p class="eyebrow">${escapeHtml(currentExercise.category)} · ${escapeHtml(currentExercise.difficulty)}</p><h1 class="practice-title">${escapeHtml(currentExercise.title)}</h1></div><div class="metrics"><div><span>Tiempo</span><strong id="time">0 s</strong></div><div><span>PPM</span><strong id="ppm">0</strong></div><div><span>Precisión</span><strong id="accuracy">100%</strong></div><div><span>Errores</span><strong id="errors">0</strong></div></div><p id="hint" class="hint">Escribe directamente sobre el texto. Si te equivocas, corrige ese carácter antes de avanzar.</p><div id="stage" class="typing-stage"><div id="target" class="target"></div><textarea id="capture" class="capture" maxlength="${length}" aria-label="Escribe el texto del ejercicio" spellcheck="false" autocomplete="off" autocapitalize="off"></textarea></div><div class="practice-actions"><span id="progress">0 / ${length} caracteres</span><span id="save-status">Haz clic en el texto para empezar</span></div></section></main>`;
        bindHeader(); app.querySelector('#back-practice').addEventListener('click', renderPracticePicker);
        const input = app.querySelector('#capture'); input.addEventListener('beforeinput', checkCharacter); input.addEventListener('input', updateTyping); input.addEventListener('keydown', (event) => { if (['ArrowLeft','ArrowRight','ArrowUp','ArrowDown','Home','End','Delete'].includes(event.key) || (event.ctrlKey && event.key.toLowerCase() === 'a')) { event.preventDefault(); focusEnd(); } });
        app.querySelector('#target').addEventListener('click', focusEnd); app.querySelector('#stage').addEventListener('click', focusEnd); input.focus(); drawTarget();
    }
    // Inicia el cronómetro una sola vez al recibir la primera tecla.
    function beginTimer() { if (startedAt !== null) return; startedAt = Date.now(); timer = setInterval(updateMetrics, 250); }
    // Mantiene el cursor al final del texto escrito para que se escriba sobre el ejercicio.
    function focusEnd() { const input = app.querySelector('#capture'); input.focus(); input.setSelectionRange(input.value.length, input.value.length); }
    // Bloquea una tecla incorrecta antes de que se incorpore al texto.
    function checkCharacter(event) {
        if (!event.inputType.startsWith('insert')) return; beginTimer();
        const input = event.currentTarget; const inserted = event.data ?? event.dataTransfer?.getData('text/plain'); if (inserted == null) return;
        const current = Array.from(input.value); const start = Array.from(input.value.slice(0, input.selectionStart)).length; const end = Array.from(input.value.slice(0, input.selectionEnd)).length;
        if (start !== current.length || end !== current.length) { event.preventDefault(); showHint('Continúa desde el carácter subrayado.', true); return; }
        const expected = Array.from(currentExercise.content); const incoming = Array.from(inserted);
        if (incoming.some((character, index) => character !== expected[current.length + index])) { event.preventDefault(); mistakes++; updateMetrics(); showHint('Ese carácter no coincide. Inténtalo otra vez para avanzar.', true); }
    }
    // Muestra instrucciones o errores debajo del texto de práctica.
    function showHint(message, error = false) { const hint = app.querySelector('#hint'); hint.textContent = message; hint.classList.toggle('error', error); }
    // Sincroniza lo escrito, descarta errores y guarda automáticamente al completar el texto.
    function updateTyping(event) {
        const chars = Array.from(event.currentTarget.value); const target = Array.from(currentExercise.content); const mismatch = chars.findIndex((character, index) => character !== target[index]);
        if (mismatch !== -1) { chars.splice(mismatch); mistakes++; showHint('Ese carácter no coincide. Inténtalo otra vez para avanzar.', true); } else { showHint('Escribe directamente sobre el texto. Si te equivocas, corrige ese carácter antes de avanzar.'); }
        typed = chars.join(''); event.currentTarget.value = typed; event.currentTarget.setSelectionRange(event.currentTarget.value.length, event.currentTarget.value.length);
        if (typed.length || mistakes) beginTimer(); drawTarget(); updateMetrics(); if (Array.from(typed).length === target.length) saveResult();
    }
    // Colorea caracteres correctos y subraya el siguiente que se debe escribir.
    function drawTarget() {
        const target = Array.from(currentExercise.content); const chars = Array.from(typed);
        app.querySelector('#target').innerHTML = target.map((character, index) => `<span class="${index < chars.length ? 'correct' : index === chars.length ? 'current' : ''}">${escapeHtml(character)}</span>`).join('');
    }
    // Calcula tiempo, palabras por minuto, precisión, errores y avance de la práctica.
    function updateMetrics() {
        if (!currentExercise || !app.querySelector('#time')) return;
        const elapsed = startedAt === null ? 0 : Math.max(1, Math.floor((Date.now() - startedAt) / 1000)); const count = Array.from(typed).length;
        const ppm = elapsed ? Math.round(count * 60 / elapsed) : 0; const accuracy = count + mistakes ? (count / (count + mistakes)) * 100 : 100;
        app.querySelector('#time').textContent = `${elapsed} s`; app.querySelector('#ppm').textContent = String(ppm); app.querySelector('#accuracy').textContent = `${accuracy.toFixed(1)}%`; app.querySelector('#errors').textContent = String(mistakes); app.querySelector('#progress').textContent = `${count} / ${Array.from(currentExercise.content).length} caracteres`;
    }
    // Envía el resultado terminado a Laravel para que aparezca en el historial del usuario.
    async function saveResult() {
        if (saving || !currentExercise) return; saving = true; const input = app.querySelector('#capture'); input.disabled = true; app.querySelector('#save-status').textContent = 'Guardando resultado…';
        const elapsed = startedAt === null ? 1 : Math.max(1, Math.floor((Date.now() - startedAt) / 1000));
        try { await request('/practice-results', { method: 'POST', body: { exercise_id: currentExercise.id, typed_text: typed, elapsed_seconds: elapsed, mistakes } }); stopTimer(); app.querySelector('#save-status').textContent = 'Práctica guardada automáticamente.'; app.querySelector('#hint').textContent = '¡Muy bien! Tu resultado quedó guardado en Mi progreso.'; }
        catch (error) { saving = false; input.disabled = false; app.querySelector('#save-status').textContent = 'No se pudo guardar.'; showHint(error.message, true); }
    }
    // Consulta y presenta el historial de prácticas de la cuenta autenticada.
    async function renderProgress() {
        stopTimer(); app.innerHTML = '<main class="auth-wrap"><p class="muted">Cargando tu progreso…</p></main>';
        try { const [result, me] = await Promise.all([request('/practice-results'), request('/me')]); user = me.data; const items = result.data;
            app.innerHTML = `${header('progress')}<main><section class="hero"><p class="eyebrow">TU AVANCE</p><h1>Mi progreso</h1><p>Revisa los resultados que has guardado con tus prácticas.</p></section><section class="card"><p class="eyebrow">HISTORIAL</p><h2>Prácticas completadas</h2>${items.length ? `<div style="overflow:auto"><table class="results"><thead><tr><th>Ejercicio</th><th>Fecha</th><th>Tiempo</th><th>PPM</th><th>Precisión</th><th>Errores</th></tr></thead><tbody>${items.map((item) => `<tr><td>${escapeHtml(item.exercise_title)}</td><td>${item.created_at ? new Date(item.created_at).toLocaleString('es-CO') : '—'}</td><td>${item.elapsed_seconds} s</td><td>${item.ppm}</td><td>${Number(item.accuracy).toFixed(1)}%</td><td>${item.errors}</td></tr>`).join('')}</tbody></table></div>` : '<p class="empty">Todavía no tienes prácticas guardadas.</p>'}</section></main>`; bindHeader();
        } catch (error) { handleLoadError(error); }
    }
    // Presenta errores de carga y cierra sesión si Laravel informa que el token venció.
    function handleLoadError(error) { if (String(error.message).toLowerCase().includes('unauthenticated')) { logout(); return; } app.innerHTML = `<main class="auth-wrap"><section class="auth-card"><p class="eyebrow">SYSTYPE</p><h1>No se pudo cargar</h1><p class="notice">${escapeHtml(error.message)}</p><button id="retry" class="button primary">Reintentar</button></section></main>`; app.querySelector('#retry').addEventListener('click', renderHome); }
    // Revoca la sesión en el servidor, limpia el token local y regresa al inicio público.
    async function logout() { try { await request('/auth/logout', { method: 'POST' }); } catch {} stopTimer(); token = null; user = null; localStorage.removeItem(tokenKey); renderLanding(); }
    // Al cargar, valida el token guardado antes de decidir entre la página pública y la privada.
    async function initialize() { if (!token) { renderLanding(); return; } try { const response = await request('/me'); user = response.data; await renderHome(); } catch { token = null; localStorage.removeItem(tokenKey); renderLanding(); } }
    initialize();
})();
</script>
</body>
</html>
