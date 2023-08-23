function modal(){
    Swal.fire({
        icon: 'success',
        title: 'Alterações salvas. Faça login novamente para acessá-las.',
        backdrop: `
            rgba(0,0,123,0.4)
            url("https://sweetalert2.github.io/images/nyan-cat.gif")
            left top
            no-repeat
        `,
        allowOutsideClick: false,
        confirmButtonText: 'Sair',
        preConfirm: async () => {
        return location = '/inDesign/pages/session/logout.php';
      }
    })
}

modal();