import preset from '../../../../vendor/filament/filament/tailwind.config.preset'

export default {
    presets: [preset],
    content: [
        './app/Filament/FrontPanel/**/*.php',
        './app/Filament/AdminPanel/**/*.php',
        './resources/views/filament/pages/**/*.blade.php',
        './vendor/filament/**/*.blade.php',
    ],
}
