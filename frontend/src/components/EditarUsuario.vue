<template>
  <div>
<form >
  <div class="form-group row">
    <label  class="col-sm-2 col-form-label" for="Nome">Nome</label>
    <div class="col-sm-10">
      <input type="text" class="form-control" v-model="usuario.nome" id="Nome" placeholder="Digite o nome">
    </div>
  </div>
  <div class="form-group row">
    <label for="Telefone" class="col-sm-2 col-form-label">Idade</label>
    <div class="col-sm-10">
    <input type="number" class="form-control" v-model="telefone" id="Idade" placeholder="Digite sua idade">
    </div>
  </div>
  <div class="form-group row">
    <label for="inputEmail3" class="col-sm-2 col-form-label">Email</label>
    <div class="col-sm-10">
      <input type="email" class="form-control" v-model="usuario.email" id="inputEmail3" placeholder="Digitel seu Email">
    </div>
  </div>
  <div class="form-group row">
    <label for="cep" class="col-sm-2 col-form-label">CEP</label>
      <div class="col-sm-10">
        <input type="text" class="form-control" v-model="cep" id="cep" placeholder="Digite seu CEP">
      </div>
  </div>
  <div class="col-auto">
      <button type="button" @click="alterarUsuario" class="btn btn-primary mb-2">Salvar</button>
  </div>
</form>
  </div>
</template>

<script>
import { Axios } from './common/http-common'
export default {
  props: ['usuario'],
  data () {
    return {

    }
  },
  mounted () {
  },
  methods: {
    alterarUsuario () {
      Axios.put('/api/users/{id}' + this.usuario.id, this.usuario)
        .then(response => {
          console.log(response)
          this.$emit('close')
        })
        .catch(function (error) {
          console.log(error)
        })
    }
  }
}
</script>

<style>
</style>
