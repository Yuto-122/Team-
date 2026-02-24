const menuIcon = document.querySelector('.c-header__hamburger-menu');
const content = document.querySelector('.l-hamberger-content');

if (menuIcon && content) {
  // メニューを閉じる
  const closeMenu = () => {
    menuIcon.classList.remove('open-menu');
    content.classList.remove('open-menu');
  };

  // Openされているか確認
  const isOpen = () => content.classList.contains('open-menu');

  // アイコンで開閉
  menuIcon.addEventListener('click', () => {
    menuIcon.classList.toggle('open-menu');
    content.classList.toggle('open-menu');
  });

  // content内のメニュー内リンクを押したら閉じる
  content.addEventListener('click', (e) => {
    if (e.target.closest('a')) {
      closeMenu();
    }
  });

  // メニュー外をクリックしたら閉じる
  document.addEventListener('click', (e) => {
    if (!isOpen()) return; // 開いてないなら何もしない

    const clickedInsideMenu = content.contains(e.target);
    const clickedIcon = menuIcon.contains(e.target);

    if (!clickedInsideMenu && !clickedIcon) {
      closeMenu();
    }
  });
}