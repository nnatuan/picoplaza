# Workspace Rules

- **NO TERMINAL EXECUTION:** Do not use `run_command` or any terminal tool. Do not execute cmd, powershell, bash, git, php, or any system commands.
- **FILE OPERATIONS ONLY:**
  - Use `view_file` to read files.
  - Use `list_dir` to explore directories.
  - Use `grep_search` to search code.
  - Use `write_to_file`, `replace_file_content`, and `multi_replace_file_content` to create and update files.
