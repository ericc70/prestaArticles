const { $} = window;

$(() => {
   
    const grid = new window.prestashop.component.Grid('open_article');
    grid.addExtension(new window.prestashop.component.GridExtensions.SubmitRowActionExtension() )

})

