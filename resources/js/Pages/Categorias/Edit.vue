<template>
  <div class="max-w-lg mx-auto py-8">
    <h2 class="text-xl font-semibold mb-6">Editar Categoría</h2>
    <form @submit.prevent="submit" class="space-y-4">
      <div>
        <label class="block mb-1 font-medium">Nombre:</label>
        <input v-model="form.nombre" type="text" class="border rounded px-3 py-1 w-full" />
        <span v-if="errors.nombre" class="text-red-500 text-xs">{{ errors.nombre }}</span>
      </div>
      <div>
        <label class="block mb-1 font-medium">Descripción:</label>
        <input v-model="form.descripcion" type="text" class="border rounded px-3 py-1 w-full" />
        <span v-if="errors.descripcion" class="text-red-500 text-xs">{{ errors.descripcion }}</span>
      </div>
      <div>
        <label class="block mb-1 font-medium">Estado:</label>
        <select v-model="form.estado" class="border rounded px-3 py-1 w-full">
          <option :value="true">Activo</option>
          <option :value="false">Inactivo</option>
        </select>
        <span v-if="errors.estado" class="text-red-500 text-xs">{{ errors.estado }}</span>
      </div>
      <div>
        <label class="block mb-1 font-medium">Prioridad:</label>
        <input v-model="form.prioridad" type="number" min="1" max="10" class="border rounded px-3 py-1 w-full" />
        <span v-if="errors.prioridad" class="text-red-500 text-xs">{{ errors.prioridad }}</span>
      </div>
      <button type="submit" class="bg-blue-600 text-white font-semibold px-4 py-2 rounded">Guardar cambios</button>
      <span v-if="success" class="text-green-500 text-sm ml-2">{{ success }}</span>
    </form>
  </div>
</template>

<script setup>
import { reactive, ref } from 'vue'
import { router, usePage } from '@inertiajs/vue3'
const page = usePage()
const categoria = page.props.categoria
const success = ref(page.props.flash?.success || '')

const form = reactive({
  nombre: categoria.nombre,
  descripcion: categoria.descripcion,
  estado: categoria.estado,
  prioridad: categoria.prioridad,
})

const errors = ref({})

function submit() {
  errors.value = {}
  router.put(`/categories/${categoria.id}`, form, {
    onError: (err) => errors.value = err,
    onSuccess: () => success.value = '¡Categoría actualizada correctamente!',
  })
}
</script>
