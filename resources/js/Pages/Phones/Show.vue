<template>
  <div class="max-w-4xl mx-auto py-8">
    <h1 class="text-3xl font-bold mb-6 border-b pb-2">Detalle Teléfono: {{ phone.phone_model }}</h1>
    <div class="bg-white p-6 rounded shadow mb-8">
      <p class="mb-2"><strong class="font-semibold">ID:</strong> {{ phone.id_phone }}</p>
      <p class="mb-2"><strong class="font-semibold">Marca:</strong> {{ phone.phone_brand }}</p>
      <p class="mb-2"><strong class="font-semibold">Modelo:</strong> {{ phone.phone_model }}</p>
      <p class="mb-2"><strong class="font-semibold">Precio:</strong> {{ phone.phone_price }}</p>
      <p class="mb-2"><strong class="font-semibold">Tamaño pantalla (pulg):</strong> {{ phone.phone_display_size }}</p>
      <p class="mb-2">
        <strong class="font-semibold">Es Smartphone:</strong>
        <span :class="phone.phone_is_smartphone ? 'text-green-600 font-semibold' : 'text-red-600 font-semibold'">
          {{ phone.phone_is_smartphone ? 'Sí' : 'No' }}
        </span>
      </p>
      <p class="mb-2"><strong class="font-semibold">Categoría:</strong> {{ phone.categoria ? phone.categoria.nombre : 'Sin categoría' }}</p>
      <p><strong class="font-semibold">Código de barras:</strong> {{ phone.codigo_barras || 'N/A' }}</p>
      <p><strong class="font-semibold">Fecha creación:</strong> {{ new Date(phone.created_at).toLocaleString() }}</p>
      <p><strong class="font-semibold">Última actualización:</strong> {{ new Date(phone.updated_at).toLocaleString() }}</p>
    </div>

    <div class="mt-6">
      <a href="/phones" class="text-blue-700 hover:underline font-semibold">Volver al listado</a>
    </div>
  </div>
</template>

<script setup>
const props = defineProps({
  phone: Object,
})
</script>
