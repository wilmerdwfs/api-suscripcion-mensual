<?php
namespace App\Domain\ValueObjects\Plan;

class Caracteristicas
{
    private int $banderas;

    // Constantes para cada bit/característica
    private const DOMINIO_PERSONALIZADO     = 1 << 0;  // 1
    private const ACCESO_API                = 1 << 1;  // 2
    private const PANEL_ANALITICAS          = 1 << 2;  // 4

    public function __construct(int $banderas = 0)
    {
        $this->banderas = $banderas;
    }

    // Crear objeto desde entero guardado en la BD
    public static function fromInt(int $banderas): self
    {
        return new self($banderas);
    }

    // Métodos para verificar si tiene una característica activa
    public function tieneDominioPersonalizado(): bool
    {
        return ($this->banderas & self::DOMINIO_PERSONALIZADO) !== 0;
    }

    public function tieneAccesoApi(): bool
    {
        return ($this->banderas & self::ACCESO_API) !== 0;
    }

    public function tienePanelAnaliticas(): bool
    {
        return ($this->banderas & self::PANEL_ANALITICAS) !== 0;
    }

    // Métodos para activar/desactivar características
    public function activarDominioPersonalizado(): void
    {
        $this->banderas |= self::DOMINIO_PERSONALIZADO;
    }

    public function desactivarDominioPersonalizado(): void
    {
        $this->banderas &= ~self::DOMINIO_PERSONALIZADO;
    }

    public function activarAccesoApi(): void
    {
        $this->banderas |= self::ACCESO_API;
    }

    public function desactivarAccesoApi(): void
    {
        $this->banderas &= ~self::ACCESO_API;
    }

    public function activarPanelAnaliticas(): void
    {
        $this->banderas |= self::PANEL_ANALITICAS;
    }

    public function desactivarPanelAnaliticas(): void
    {
        $this->banderas &= ~self::PANEL_ANALITICAS;
    }
}