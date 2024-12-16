// resources/js/custom.js
function breadcrumbData() {
    const path = window.location.pathname;
    const segments = path.split('/').filter(Boolean);
    const baseUrl = window.location.origin;

    const breadcrumbs = segments.map((segment, index) => {
        const url = baseUrl + '/' + segments.slice(0, index + 1).join('/');
        return {
            label: segment.charAt(0).toUpperCase() + segment.slice(1).replace(/-/g, ' '),
            url: url
        };
    });

    return { breadcrumbs };
}
