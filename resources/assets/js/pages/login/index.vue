<template>
    <div class="login-container">
        <el-form class="login-form" autoComplete="on" :model="loginForm" :rules="loginRules" ref="loginForm" label-position="left">
            <h3 class="title">后台管理系统</h3>

            <el-form-item prop="username">
                <span class="svg-container"><svg-icon icon-class="user"></svg-icon></span>
                <el-input name="username"
                          type="text"
                          v-model="loginForm.username"
                          autoComplete="on"
                          placeholder="username">
                </el-input>
            </el-form-item>

            <el-form-item prop="password">
                <span class="svg-container"><svg-icon icon-class="password"></svg-icon></span>
                <el-input name="password"
                          :type="pwdType"
                          v-model="loginForm.password"
                          @keyup.enter.native="handleLogin"
                          autoComplete="on"
                          placeholder="password">
                </el-input>
                <span class="show-pwd" @click="showPwd"><svg-icon icon-class="eye"></svg-icon></span>
            </el-form-item>

            <el-form-item>
                <el-button type="primary" style="width:100%;" :loading="loading" @click.native.prevent="handleLogin">
                    登 录
                </el-button>
            </el-form-item>

        </el-form>
    </div>
</template>

<script>
    import { isvalidUsername } from './Validate';

    export default {
        name: "index",
        data() {
            const validateUsername = (rule, value, callback) => {
                if (!isvalidUsername(value)) {
                    callback(new Error('请输入正确的用户名'))
                } else {
                    callback()
                }
            };

            const validatePass = (rule, value, callback) => {
                if (value.length < 5) {
                    callback(new Error('密码不能小于5位'))
                } else {
                    callback()
                }
            };

            return {
                loading: false,
                pwdType: 'password',
                loginForm: {
                    username: '',
                    password: ''
                },
                loginRules: {
                    username: [{ required: true, trigger: 'blur', validator: validateUsername }],
                    password: [{ required: true, trigger: 'blur', validator: validatePass }]
                },
            }
        },
        methods: {
            showPwd() {
                if (this.pwdType === 'password') {
                    this.pwdType = ''
                } else {
                    this.pwdType = 'password'
                }
            },
            handleLogin() {
                this.$refs.loginForm.validate(valid => {
                    if (valid) {
                        this.loading = true;
                        this.$store.dispatch('Login', this.loginForm).then(() => {
                            this.loading = false;
                            this.$router.push({ path: '/' })
                        }).catch(() => {
                            this.loading = false;
                        })
                    } else {
                        console.log('error submit!!');
                        return false
                    }
                })
            }
        }
    }
</script>

<style rel="stylesheet/scss" lang="scss" scoped>
    $bg: #2d3a4b;
    $dark_gray: #889aa4;
    $light_gray: #eee;

    .login-container {
        position: fixed;
        height: 100%;
        width: 100%;
        background-color: $bg;

        .login-form {
            position: absolute;
            left: 0;
            right: 0;
            width: 520px;
            padding: 35px 35px 15px 35px;
            margin: 120px auto;

            .title {
                font-size: 26px;
                font-weight: 400;
                color: $light_gray;
                margin: 0 auto 40px auto;
                text-align: center;
            }

            .svg-container {
                padding: 6px 5px 6px 15px;
                color: $dark_gray;
                vertical-align: middle;
                width: 30px;
                display: inline-block;

                &_login {
                    font-size: 20px;
                }
            }

            .show-pwd {
                position: absolute;
                right: 10px;
                top: 7px;
                font-size: 16px;
                color: $dark_gray;
                cursor: pointer;
                user-select: none;
            }
        }
    }
</style>

<style rel="stylesheet/scss" lang="scss">
    /* reset element-ui css */
    .login-container {
        .el-input {
            display: inline-block;
            height: 47px;
            width: 85%;

            input {
                background: transparent;
                border: 0;
                -webkit-appearance: none;
                border-radius: 0;
                padding: 12px 5px 12px 15px;
                color: #eee;
                height: 47px;

                &:-webkit-autofill {
                    -webkit-box-shadow: 0 0 0 1000px #2d3a4b inset !important;
                    -webkit-text-fill-color: #fff !important;
                }
            }
        }

        .el-form-item {
            border: 1px solid rgba(255, 255, 255, 0.1);
            background: rgba(0, 0, 0, 0.1);
            border-radius: 5px;
            color: #454545;
        }
    }
</style>