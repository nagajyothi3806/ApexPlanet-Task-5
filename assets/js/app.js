document.addEventListener('DOMContentLoaded', () => {
  const input = document.getElementById('courseSearch');
  const category = document.getElementById('categoryFilter');
  const results = document.getElementById('courseResults');
  if (!input || !category || !results) return;
  let timer;
  const escapeHtml = value => String(value ?? '').replace(/[&<>"']/g, ch => ({'&':'&amp;','<':'&lt;','>':'&gt;','"':'&quot;',"'":'&#39;'}[ch]));
  async function loadCourses() {
    results.innerHTML = '<p class="muted">Searching…</p>';
    const params = new URLSearchParams({q:input.value.trim(), category:category.value});
    try {
      const response = await fetch(`${window.LEARNSPACE_BASE}/api/search_courses.php?${params}`);
      const data = await response.json();
      if (!response.ok || data.error) throw new Error(data.error || 'Search failed');
      if (!data.courses.length) { results.innerHTML='<div class="empty panel"><h3>No courses found</h3><p class="muted">Try another search or category.</p></div>'; return; }
      results.innerHTML = data.courses.map(c => `<article class="course-card"><div class="course-art">${escapeHtml((c.category||'L').slice(0,1))}</div><div class="card-body"><span class="pill">${escapeHtml(c.category)}</span><h3>${escapeHtml(c.title)}</h3><p>${escapeHtml(c.description)}</p><div class="card-foot"><span>${escapeHtml(c.level)} · ${Number(c.duration_hours)} hours</span><a href="${window.LEARNSPACE_BASE}/course.php?id=${Number(c.id)}">Details →</a></div></div></article>`).join('');
    } catch (error) { results.innerHTML = `<div class="alert error">${escapeHtml(error.message)}. Check your database setup.</div>`; }
  }
  input.addEventListener('input', () => { clearTimeout(timer); timer=setTimeout(loadCourses,250); });
  category.addEventListener('change', loadCourses);
  loadCourses();
});
