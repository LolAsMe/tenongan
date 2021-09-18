<template>
  <div class="dropdown">
    <button
      class="btn btn-primary dropdown-toggle btn-sm"
      type="button"
      :id="id"
      data-bs-toggle="dropdown"
      aria-expanded="false"
    >
      {{ name }}
    </button>
    <ul class="dropdown-menu" :aria-labelledby="id">
      <slot>
        <li><a class="dropdown-item" href="#">Action</a></li>
        <li><a class="dropdown-item" href="#">Another action</a></li>
        <li><a class="dropdown-item" href="#">Something else here</a></li>
      </slot>
    </ul>
  </div>
</template>

<script>
export default {
  name: "Dropdown",

  props: {
    id: { type: String, default: "dropdownMenuButton1" },
    name: { type: String, default: "Dropdown" },
  },
};
</script>
