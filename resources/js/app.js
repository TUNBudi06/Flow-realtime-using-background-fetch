import { Livewire } from '../../vendor/livewire/livewire/dist/livewire.esm';
Livewire.start()

// Recommended way, to include only the icons you need.
import { createIcons, Menu, ArrowRight, Globe } from 'lucide';

createIcons({
    icons: {
        Menu,
        ArrowRight,
        Globe
    }
});
