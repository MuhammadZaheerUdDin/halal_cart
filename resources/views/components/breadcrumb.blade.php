<div x-data="breadcrumbData()" class="flex items-center space-x-2 text-gray-600">
    <!-- Home Icon -->
    <a href="/" class="hover:text-blue-600">
        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10l1.89-1.89c.63-.63 1.71-.18 1.71.7v7.17c0 .88 1.08 1.33 1.71.7L12 14.59l4.71 4.71c.63.63 1.71.18 1.71-.7v-7.17c0-.88 1.08-1.33 1.71-.7L21 10m0 0L12 3 3 10" />
        </svg>
    </a>
    <template x-for="(crumb, index) in breadcrumbs" :key="index">
        <div class="flex items-center">
            <span class="mx-2">/</span>
            <template x-if="index === breadcrumbs.length - 1">
                <span class="font-semibold text-gray-800" x-text="crumb.label"></span>
            </template>
            <template x-if="index < breadcrumbs.length - 1">
                <a :href="crumb.url" class="hover:text-blue-600" x-text="crumb.label"></a>
            </template>
        </div>
    </template>
</div>
