<template>
  <div>
<form>
  <div class="form-group row">
    <label  class="col-sm-2 col-form-label" for="Nome">Nome</label>
    <div class="col-sm-10">
    <input type="text" class="form-control" v-model="nome" id="Nome" placeholder="Digite seu nome">
    </div>
  </div>
  <div class="form-group row">
    <label for="Idade" class="col-sm-2 col-form-label">Idade</label>
    <div class="col-sm-10">
    <input type="number" class="form-control" v-model="idade" id="Idade" placeholder="Digite sua idade">
    </div>
  </div>
  <div class="form-group row">
    <label for="inputEmail3" class="col-sm-2 col-form-label">Email</label>
    <div class="col-sm-10">
      <input type="email" class="form-control" v-model="email" id="inputEmail3" placeholder="Digite seu Email">
    </div>
  </div>
  <div class="form-group row">
      <label for="cep" class="col-sm-2 col-form-label">CEP</label>
      <div class="col-sm-10">
        <input type="text" class="form-control" v-model="cep" id="cep" placeholder="Digite seu CEP">
      </div>
    </div>
    <div class="col-auto">
      <button type="button" @click="salvarUsuario" class="btn btn-primary mb-2">Salvar</button>
    </div>
</form>
  </div>
</template>

<script>
import { Axios } from './common/http-common'
export default {
  data () {
    return {
      nome: '',
      idade: '',
      email: '',
      cep: ''
    }
  },
  methods: {
    salvarUsuario () {
      const param = {
        nome: this.nome,
        idade: this.idade,
        email: this.email,
        cep: this.cep
      }
      Axios.post('/users', param)
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
