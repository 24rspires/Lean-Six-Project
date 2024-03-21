
from os import walk, getcwd
from os.path import join

def get_lines(file):
    try:
        with open(file) as f:
            return len(f.readlines())
    except Exception:
        return 0

def main():
    extension = input('files to read lines of: ')
    total = 0
    for root, directories, filenames in walk(getcwd()):
        for file in filenames:
            if extension in file or extension == '*':
                line_count = get_lines(join(root, file))
                total += line_count
    print(f'total lines of {extension}: {total}')
    input('...')
    main()

main()