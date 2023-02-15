<template>
  <div class="container">
    <div class="row">
      <form style="width: 100%" @submit.prevent="send">
        <div
          class="form-group row"
          :class="{ error: v$.form.title.$errors.length }"
        >
          <label for="title" class="col-md-2 col-form-label">Заголовок</label>
          <div class="col-md-10 position-relative">
            <input
              type="text"
              class="form-control"
              id="title"
              name="title"
              v-model="v$.form.title.$model"
              @blur="v$.form.title.$touch"
              
            />
            <div class="invalid-feedback">
            </div>
            <p class="text-danger">
                {{ errors.title !== '' ? errors.title : ''}}
              </p>
            <div
              class="input-errors"
              v-for="(error, index) of v$.form.title.$errors"
              :key="index"
            >
              <div class="error-msg">{{ error.$message }}</div>
            </div>
          </div>
        </div>

        <div
          class="form-group row"
          :class="{ error: v$.form.annotation.$errors.length }"
        >
          <label for="annotation" class="col-md-2 col-form-label"
            >Аннотация</label
          >
          <div class="col-md-10">
            <textarea
            
              name="annotation"
              id="annotation"
              class="form-control"
              cols="30"
              rows="10"
              v-model="v$.form.annotation.$model"
              @blur="v$.form.annotation.$touch"
            ></textarea>

            <div class="invalid-feedback"></div>
            <p class="text-danger">
                {{ errors.annotation !== '' ? errors.annotation : ''}}
              </p>
            <div
              class="input-errors"
              v-for="(error, index) of v$.form.annotation.$errors"
              :key="index"
            >
              <div class="error-msg">{{ error.$message }}</div>
            </div>
          </div>
        </div>

        <div
          class="form-group row"
          :class="{ error: v$.form.content.$errors.length }"
        >
          <label for="content" class="col-md-2 col-form-label"
            >Текст новости</label
          >
          <div class="col-md-10">
            <textarea
              name="content"
              id="content"
              class="form-control"
              cols="30"
              rows="10"
              v-model="v$.form.content.$model"
              @blur="v$.form.content.$touch"
            ></textarea>
            <div class="invalid-feedback"></div>
            <p class="text-danger">
                {{ errors.content !== '' ? errors.content : ''}}
              </p>
            <div
              class="input-errors"
              v-for="(error, index) of v$.form.content.$errors"
              :key="index"
            >
              <div class="error-msg">{{ error.$message }}</div>
            </div>
          </div>
        </div>

        <div
          class="form-group row"
          :class="{ error: v$.form.email.$errors.length }"
        >
          <label for="email" class="col-md-2 col-form-label"
            >Email автора для связи</label
          >
          <div class="col-md-10">
            <input
              type="email"
              class="form-control"
              id="email"
              name="email"
              v-model="v$.form.email.$model"
              @blur="v$.form.email.$touch"
            />
            <div class="invalid-feedback"></div>
            <p class="text-danger">
                {{ errors.email !== '' ? errors.email : ''}}
              </p>
            <div
              class="input-errors"
              v-for="(error, index) of v$.form.email.$errors"
              :key="index"
            >
              <div class="error-msg">{{ error.$message }}</div>
            </div>
          </div>
        </div>

        <div
          class="form-group row"
          :class="{ error: v$.form.views.$errors.length }"
        >
          <label for="views" class="col-md-2 col-form-label"
            >Кол-во просмотров</label
          >
          <div class="col-md-10">
            <input
              type="number"
              class="form-control"
              id="views"
              name="views"
              min="0"
              max="2147483647"
              v-model="v$.form.views.$model"
              @blur="v$.form.views.$touch"
            />
            <div class="invalid-feedback"></div>
            <p class="text-danger">
                {{ errors.views !== '' ? errors.views : ''}}
              </p>
            <div
              class="input-errors"
              v-for="(error, index) of v$.form.views.$errors"
              :key="index"
            >
              <div class="error-msg">{{ error.$message }}</div>
            </div>
          </div>
        </div>

        <div
          class="form-group row"
          :class="{ error: v$.form.views.$errors.length }"
        >
          <label for="date" class="col-md-2 col-form-label"
            >Дата публикации</label
          >
          <div class="col-md-10">
            <input
              type="date"
              class="form-control"
              id="date"
              name="date"
              v-model="v$.form.date.$model"
            />
            <div class="invalid-feedback"></div>
            <!-- <p class="text-danger">
                {{ errors.date !== '' ? errors.date : ''}}
            </p> -->
            <div
              class="input-errors"
              v-for="(error, index) of v$.form.date.$errors"
              :key="index"
            >
              <div class="error-msg">{{ error.$message }}</div>
            </div>
          </div>
        </div>

        <div class="form-group row">
          <label for="is_publish" class="col-md-2 col-form-label"
            >Публичная новость</label
          >
          <div class="col-md-10">
            <input
              type="checkbox"
              class="form-control"
              id="is_publish"
              name="is_publish"
              v-model="form.is_publish"
              checked
            />
            <div class="invalid-feedback"></div>
          </div>
        </div>

        <div
          class="form-group row"
          :class="{ error: v$.form.publish_in_index.$errors.length }"
        >
          <label class="col-md-2 col-form-label">Публиковать на главной</label>
          <div class="col-md-10">
            <div class="form-check">
              <input
                class="form-check-input"
                type="radio"
                name="publish_in_index"
                v-model="v$.form.publish_in_index.$model"
                @blur="v$.form.publish_in_index.$touch"
                required
                id="publish_in_index_yes"
                :checked="valid"
              />
              <label class="form-check-label" for="publish_in_index_yes">
                Да
              </label>
            </div>
            <div class="form-check">
              <input
                class="form-check-input"
                type="radio"
                name="publish_in_index"
                v-model="v$.form.publish_in_index.$model"
                @blur="v$.form.publish_in_index.$touch"
                required
                id="publish_in_index_no"
              />
              <label class="form-check-label" for="publish_in_index_no">
                Нет
              </label>
            </div>
            <div class="invalid-feedback"></div>
            <div
              class="input-errors"
              v-for="(error, index) of v$.form.publish_in_index.$errors"
              :key="index"
            >
              <div class="error-msg">{{ error.$message }}</div>
            </div>
          </div>
        </div>

        <div class="form-group row">
          <label for="category" class="col-md-2 col-form-label"
            >Публичная новость</label
          >
          <div class="col-md-10">
            <select
              id="category"
              class="form-control"
              name="category"
              v-model="form.category"
              
            >
            <option disabled selected>Выберете категорию из списка..</option>
              <option value="1">Спорт</option>
              <option value="2">Культура</option>
              <option value="3">Политика</option>
            </select>
            <div class="invalid-feedback"></div>
            <p class="text-danger">
                {{ errors.category !== '' ? errors.category : ''}}
            </p>
          </div>
        </div>

        <div class="form-group row">
          <div class="col-md-9">
            <button type="submit" name="submit" class="btn btn-primary">
              Отправить
            </button>
          </div>
          <div class="col-md-3" >
            <div class="alert alert-success" v-if="valid === true">Форма валидна
             
            </div>
          </div>
        </div>
      </form>
    </div>
  </div>
</template>

<script>
// import {axiosInstance} from "../utils/axios.js";
import axios from "axios";
import useVuelidate from "@vuelidate/core";


import {
  required,
  email,
  minLength,
  maxLength,
  integer,
  maxValue
} from "@vuelidate/validators";

export default {
  name: "FormApp",
  setup() {
    return { v$: useVuelidate() };
  },

  data() {
    return {
      form: {
        title: "",
        annotation: "",
        content: "",
        email: "",
        views: "",
        date: "",
        is_publish: "",
        publish_in_index: "",
        category: "",
      },

      errors: [
      ],
      valid: true,
    };
  },

  validations() {
    return {
      form: {
        title: {
          required,
          min: minLength(3),
          max: maxLength(255),
        },
        annotation: {
          max: maxLength(500),
        },
        content: {
          max: maxLength(30000),
        },
        email: {
          required,
          email,
        },
        views: {
          integer,
          min: minLength(0),
          max: maxLength(2147483647),
        },
        date: {
          maxValue: maxValue(
            new Date().toLocaleDateString("en-GB").replaceAll("/", "-")
          ),
        },
        publish_in_index: {
          required,
        },
      },
    };
  },

  computed: {
    formData() {
      return {
        title: this.form.title,
        annotation: this.form.annotation,
        content: this.form.content,
        email: this.form.email,
        views: this.form.views,
        date: this.form.date,
        is_publish: this.form.is_publish,
        publish_in_index: this.form.publish_in_index,
        category: this.form.category,
        errors: this.errors,
        valid: this.valid,
      };
    },

  },

  methods: {
    async send() {
      try {
        if (this.v$.$error && this.valid === false) {
          return;
        } else {
        const response = await axios.post("/validator.php", this.formData);
        console.log(response);
        this.valid = response.data.errors[1];
        this.errors = response.data.errors[2];
        return response.data;
      }
        
      } catch (error) {
        console.error(error);
      } 
    },

    
  },
};
</script>

<style scoped>
.input-errors {
  font-size: 12px;
  color: red;
  line-height: 1.3;
}
</style>
