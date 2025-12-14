<div class="p-4 rounded-lg border bg-gray-50 space-y-3">

    <div class="flex justify-between text-sm">
        <span class="font-medium text-gray-600">Total servicios</span>
        <span class="font-semibold">
            ${{ number_format($totalServicios, 0, ',', '.') }}
        </span>
    </div>

    <hr>

    <div class="flex justify-between text-lg font-bold text-primary-600">
        <span>Total general</span>
        <span>
            ${{ number_format($totalGeneral, 0, ',', '.') }}
        </span>
    </div>

</div>
