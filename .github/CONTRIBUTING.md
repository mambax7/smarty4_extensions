![alt XOOPS CMS](https://xoops.org/images/logoXoopsPhp81.png)
# Contributing to xoops/smartyextensions
[![Software License](https://img.shields.io/badge/license-GPL-brightgreen.svg?style=flat)](https://www.gnu.org/licenses/gpl-2.0.html)

Contributions are **welcome** and will be fully **credited**.

We accept contributions via Pull Requests on [GitHub](https://github.com/mambax7/smartyextensions).

---

## Local setup

**Requirements:** PHP 8.2+, Composer.

### Git Bash / WSL / macOS / Linux

```bash
git clone https://github.com/mambax7/smartyextensions.git
cd smartyextensions
make install     # composer install
make ci          # lint → analyse → test
```

### Windows (PowerShell)

`make` is not available on Windows by default. Use the PowerShell equivalents in `scripts/`:

```powershell
git clone https://github.com/mambax7/smartyextensions.git
cd smartyextensions
.\scripts\setup.ps1   # composer install
.\scripts\ci.ps1      # lint → analyse → test
```

### First-run note: PHPStan baseline

`phpstan-baseline.neon` ships as an intentionally empty file. On a completely
clean run, PHPStan at level max may surface pre-existing findings in the source.
If that happens, generate the baseline once before treating `composer analyse`
as a hard gate:

```bash
# Unix
make baseline

# Windows
.\scripts\baseline.ps1
```

Then commit `phpstan-baseline.neon`. Subsequent runs will only fail on errors
introduced after the baseline — that is the intended workflow. Do not use
baseline generation to silence a new error you just introduced; fix the error.

---

## Pull Requests

- **[PSR-12 Coding Standard](https://www.php-fig.org/psr/psr-12/)** — run `composer lint` (or `.\scripts\ci.ps1`) to check, `composer fix` to auto-correct.
- **Add tests** — new behaviour must be covered by a test in `tests/Unit/`. PHPUnit uses the attribute syntax (`#[Test]`, `#[CoversClass(...)]`); no docblock annotations.
- **Document any change in behaviour** — update `CHANGELOG.md` under `[Unreleased]` and, if the change is template-author-visible, update `docs/TUTORIAL.md`.
- **Consider our release cycle** — we follow [Semantic Versioning 2.0.0](https://semver.org/). Breaking public API changes require a major version bump.
- **One pull request per feature** — if you want to do more than one thing, send multiple pull requests.
- **Send coherent history** — squash intermediate commits before submitting.

Happy coding, and **_May the Source be with You_**!
