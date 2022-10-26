document.addEventListener('DOMContentLoaded', function (e) {

    console.log('Validation des formulaires');

    const registerForm = document.getElementById('register-form');
    FormValidation.formValidation(registerForm, {
        fields: {
            user_login: {
                validators: {
                    notEmpty: {
                        message: 'Veuillez saisir un identifiant',
                    },
                    stringLength: {
                        min: 1,
                        max: 30,
                        message: 'Login doit contenir au moins 1 caractères',
                    },
                },
            },

            user_email: {
                validators: {
                    notEmpty: {
                        message: 'Veuillez saisir une adresse e-mail',
                    },
                    emailAddress: {
                        message: 'Saisissez une adresse e-mail valide'
                    },
                },
            },

            user_mdp: {
                validators: {
                    notEmpty: {
                        message: 'Veuillez saisir un mot de passe',
                    },
                    stringLength: {
                        min: 4,
                        message: 'Le mot de passe doit faire 4 caractères au moins',
                    },
                },
            },

            confirm_mdp: {
                validators: {
                    identical: {
                        compare: function () {
                            return registerForm.querySelector('#user_mdp').value;
                        },
                        message: 'Les mots de passes doivent être identiques',
                    },

                }
            },
        },
        plugins: {
            message: new FormValidation.plugins.Message({ clazz: 'error' }),
            trigger: new FormValidation.plugins.Trigger(),
            submitButton: new FormValidation.plugins.SubmitButton(),
            defaultSubmit: new FormValidation.plugins.DefaultSubmit(),
        },
    });
});
