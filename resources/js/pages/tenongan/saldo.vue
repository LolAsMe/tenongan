<template>
  <div class="row">
    <div class="col">
      <card :title="'Saldo'">
        {{ 'ini halaman Saldo' }}
      </card>
    </div>
  </div>
</template>

<script>
// import axios from 'axios'
export default {
  middleware: 'auth',

  // async asyncData () {
  //   const { data: projects } = await axios.get('/api/projects')

  //   return {
  //     projects
  //   }
  // },

  metaInfo () {
    return { title: "Saldo" }
  }
}
</script>
