<?php

namespace App\Livewire;

use Livewire\Component;

class MenuGneral extends Component
{
    public $isOpen = false;
    public $searchTerm = '';
    public $menuItems = [
        [
            'name' => 'Paquetes',
            'icon' => 'fas fa-box',
            'route' => 'paquetes',
            'keywords' => ['paquetes', 'tours', 'viajes', 'ofertas']
        ],
        [
            'name' => 'Promociones',
            'icon' => 'fas fa-tags',
            'route' => 'Promociones',
            'keywords' => ['promociones', 'descuentos', 'ofertas', 'rebaja']
        ],
        [
            'name' => 'Destinos',
            'icon' => 'fas fa-map-marker-alt',
            'route' => 'destinos',
            'keywords' => ['destinos', 'lugares', 'ciudades', 'países']
        ],
        [
            'name' => 'Servicios',
            'icon' => 'fas fa-concierge-bell',
            'route' => 'servicios',
            'keywords' => ['servicios', 'atención', 'soporte', 'ayuda']
        ],
        [
            'name' => 'Equipos',
            'icon' => 'fas fa-users',
            'route' => 'equipos',
            'keywords' => ['equipos', 'staff', 'equipo', 'personal']
        ],
        [
            'name' => 'Login',
            'icon' => 'fas fa-sign-in-alt',
            'route' => 'login',
            'keywords' => ['login', 'iniciar', 'sesión', 'entrar']
        ],
        [
            'name' => 'Registrar',
            'icon' => 'fas fa-user-plus',
            'route' => 'register',
            'keywords' => ['registrar', 'registro', 'crear', 'cuenta']
        ]
    ];

    public function toggleMenu()
    {
        $this->isOpen = !$this->isOpen;
    }

    public function closeMenu()
    {
        $this->isOpen = false;
    }

    public function getFilteredMenuItems()
    {
        if (empty($this->searchTerm)) {
            return $this->menuItems;
        }

        return array_filter($this->menuItems, function ($item) {
            $searchLower = strtolower($this->searchTerm);
            
            // Buscar en el nombre del item
            if (strpos(strtolower($item['name']), $searchLower) !== false) {
                return true;
            }
            
            // Buscar en las keywords
            foreach ($item['keywords'] as $keyword) {
                if (strpos(strtolower($keyword), $searchLower) !== false) {
                    return true;
                }
            }
            
            return false;
        });
    }
    
    public function render()
    {
        return view('livewire.menu-gneral',[
            'filteredItems' => $this->getFilteredMenuItems()
        ]);
    }
}