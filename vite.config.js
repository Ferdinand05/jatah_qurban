import { defineConfig } from "vite";
import laravel, { refreshPaths } from "laravel-vite-plugin";
import tailwindcss from "@tailwindcss/vite";

export default defineConfig({
    plugins: [
        laravel({
            input: ["resources/css/app.css", "resources/js/app.js", "resources/css/filament/admin/theme.css"],
            refresh: true,
        }),
        tailwindcss(),
    ],
    refresh: [
        ...refreshPaths,
        "app/Livewire/**",
        "app/Filament/**",
        "app/Providers/**",
    ],
    server: {
        watch: {
            ignored: ["**/storage/framework/views/**"],
        },
    },
});
